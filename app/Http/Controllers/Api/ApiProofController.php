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

            $proof = new ProofService($wallet->wallet_binance_api_key, $wallet->BinanceService);

            $symbol = $request->input('symbol');
            $orderId = $request->input('order_id');

            $result = $proof->getFutureProof($symbol, $orderId);

            # if error
            if ($result['status'] != 200) {
                return $this->error($result['data'], 400);
            } else {
                $pnls = $wallet->tradePnls()->create([
                    'wallet_pnl_amount' => $futures['pnl'],
                    'wallet_pnl_percentage' => $futures['pnl_percent'],
                    'wallet_pnl_date' =>  Carbon::createFromFormat('Y-m-d H:i', $futures['human_time'])->format('Y-m-d'),
                    'wallet_pnl_view' => 0,
                    // 'wallet_proof_id' => $result['data']['proof_id'],
                    'wallet_pnl_symbol' => $futures['symbol'],
                    'wallet_proof_data' => serialize($result['data'])
                ]);
                return $this->success($result['data']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->error($e->getMessage(), 400);
        }
    }
}
