<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Models\Wallet;
use App\Services\ProofService;

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


        $proof = new ProofService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

        $symbol = $request->query('symbol');
        $orderId = $request->query('order_id');

        $result = $proof->getFutureProof($symbol, $orderId);
        if ($result['status'] != 200) {
            return $this->error($result['data'], 400);
        }

        return $this->success($result['data']);
    }
}
