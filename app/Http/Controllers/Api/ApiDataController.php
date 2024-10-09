<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Models\Wallet;
use App\Services\BinanceService;
use Carbon\Carbon;

class ApiDataController extends Controller
{
    use ApiResponseTrait;

    function check(Request $request)
    {
        $key = $request->query('api_key') ?? $request->query('wallet_binance_api_key');
        $secret = $request->query('api_secret') ?? $request->query('wallet_binance_api_secret');

        if (!$key || !$secret) return $this->error('API key or Secret cannot be empty', 400);

        $binance = new BinanceService($key, $secret);
        $binance_account = $binance->account();
        if (!$binance_account) return $this->error('Invalid API Key or Secret', 400);

        return $this->success($binance_account);
    }

    function assets(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);

        return $this->success($binance->asset());
    }

    /**
     * Get available futures pair list
     * 
     * @param Request $request
     * @param string $wallet
     * @return JsonResponse
     */
    function futures_pair_list(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return $this->error('Wallet not found', 404);

        $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);
        $results = $binance->getFuturesAccountTradeList('');
        if (!$results) return $this->error('No data found', 404);

        $results = collect($results)->map(function ($item) {
            return $item['symbol'];
        })->unique();

        return $this->success(
            $results
        );
    }

    function futures(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return $this->error('Wallet not found', 404);

        $symbol = $request->query('symbol');

        try {
            $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);
            $result = $binance->getFuturesAccountTradeList($symbol);
            if (count($result) == 0) return $this->error('No data found', 404);

            $result = collect($result)
                ->groupBy('orderId')
                ->map(function ($orders) {
                    return [
                        'buyer' => $orders->first()['buyer'],
                        'commission' => $orders->sum(function ($order) {
                            return (float)$order['commission'];
                        }),
                        'commissionAsset' => $orders->first()['commissionAsset'],
                        'maker' => $orders->first()['maker'],
                        'orderId' => $orders->first()['orderId'],
                        'realizedPnl' => $orders->sum(function ($order) {
                            return (float)$order['realizedPnl'];
                        }),
                        'symbol' => $orders->first()['symbol'],
                        'time' => $orders->first()['time'],
                        'human_time' => Carbon::createFromTimestampMs($orders->first()['time'])->format('Y-m-d H:i:s'),
                    ];
                })->where('realizedPnl', '!=', 0);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success($result);
    }

    function futures_summary(Request $request, $wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $symbol = $request->query('symbol');
        $orderId = $request->query('order_id');

        try {
            $binance = new BinanceService($wallet->wallet_binance_api_key, $wallet->wallet_binance_api_secret);
            $result = $binance->getFuturesAccountTradeSummary($symbol, $orderId);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success($result);
    }
}
