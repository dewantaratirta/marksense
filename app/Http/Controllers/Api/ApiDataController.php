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
        $key = $request->query('api_key') ?? $request->query('wallet_binance_api_key');
        $secret = $request->query('api_secret') ?? $request->query('wallet_binance_api_secret');

        if(!$key || !$secret) return $this->error('API key or Secret cannot be empty', 400);
        
        $binance = new BinanceService($key, $secret);
        $binance_account = $binance->account();
        if(!$binance_account) return $this->error('Invalid API Key or Secret', 400);

        return $this->success($binance_account);
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
