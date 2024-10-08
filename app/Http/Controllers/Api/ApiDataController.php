<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Models\Wallet;
use App\Services\BinanceService;

class ApiDataController extends Controller
{
    use ApiResponseTrait;

    function check(Request $request)
    {
        $key = $request->query('api_key');
        $secret = $request->query('api_secret');

        $binance = new BinanceService($key, $secret);

        return $this->success($binance->account());
    }

    function assets(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

        return $this->success($binance->asset());
    }

    function futures(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $symbol = $request->query('symbol');

        $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

        return $this->success($binance->getFuturesAccountTradeList($symbol));
    }

    function futures_summary(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $symbol = $request->query('symbol');
        $orderId = $request->query('order_id');

        $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

        return $this->success($binance->getFuturesAccountTradeSummary($symbol, $orderId));
    }
}
