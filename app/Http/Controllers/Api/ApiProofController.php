<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Models\Wallet;
use App\Services\ProofService;
use App\Services\BinanceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ApiProofController extends Controller
{
    use ApiResponseTrait;

    function asset(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return $this->error('Wallet not found', 404);

        $proof = new ProofService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

        $asset = $request->query('asset');
        $result = $proof->getAssetProof($asset);
        if ($result['status'] != 200) {
            return $this->error($result['data'], 400);
        }

        return $this->success($result['data']);
    }

    function future(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return $this->error('Wallet not found', 404);
        $rules = [
            'symbol' => 'required',
            'reserve_ulid' => 'required|min:26|max:26',
            'order_id' => 'required|numeric',
            'file' => 'required|file'
        ];
        $valid = $this->validate($request, $rules);

        try {

            $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);
            $futures = $binance->getFuturesAccountTradeSummary($valid['symbol'], $valid['order_id']);

            $proof = new ProofService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

            $symbol = $request->input('symbol');
            $orderId = $request->input('order_id');

            $result = $proof->getFutureProof($symbol, $orderId);

            # if error
            if ($result['status'] != 200) {
                return $this->error($result['data'], 400);
            } else {
                $pnl = new \App\Models\TradePnl();
                $pnl->fill([
                    'trade_pnl_amount' => $futures['pnl'],
                    'trade_pnl_percentage' => $futures['pnl_percent'],
                    'trade_pnl_date' =>  Carbon::createFromFormat('Y-m-d H:i', $futures['human_time'])->format('Y-m-d'),
                    'trade_pnl_view' => 0,
                    // 'trade_proof_id' => $result['data']['proof_id'],
                    'trade_pnl_symbol' => $symbol,
                    'trade_pnl_trade_id' => $orderId,
                    'trade_proof_data' => serialize($result['data']),
                    'ulid' => $valid['reserve_ulid'],
                    'wallet_id' => $wallet->id
                ])->save();
                $pnl->addMedia($request->file('file'))
                ->toMediaCollection('image', 'uploads');

                return $this->success($result['data']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->error($e->getMessage(), 400);
        }
    }
}
