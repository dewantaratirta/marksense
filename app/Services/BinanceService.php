<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BinanceService
{
    protected $recvWindow = 60000;
    protected $apiKey;
    protected $apiSecret;
    protected $baseUri = 'https://api.binance.com';
    protected $futureBaseUri = 'https://fapi.binance.com';
    protected $client;

    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    public function account()
    {

        $this->client = new Client(['base_uri' => $this->baseUri]);

        $queryParams = [
            'recvWindow' => $this->recvWindow,
            'timestamp' => time() * 1000,
        ];

        // Signature
        $queryParams['signature'] = $this->sign($queryParams);

        try {
            $response = $this->client->request('GET', '/api/v3/account', [
                'headers' => [
                    'X-MBX-APIKEY' => $this->apiKey,
                ],
                'query' => $queryParams,
            ]);

            $result = $response->getBody();

            return !empty($result);
        } catch (\Exception $e) {
            Log::error('Error fetching Binance check account: ' . $e->getMessage());
            return false;
        }
    }

    public function getFuturesAccountTradeList($symbol, $startTime = null, $endTime = null, $limit = 500)
    {

        $this->client = new Client(['base_uri' => $this->futureBaseUri]);

        $queryParams = [
            'symbol' => $symbol,
            'limit' => $limit,
            'recvWindow' => $this->recvWindow,
            'timestamp' => time() * 1000,
        ];

        if ($startTime) {
            $queryParams['startTime'] = $startTime;
        }

        if ($endTime) {
            $queryParams['endTime'] = $endTime;
        }

        // Signature
        $queryParams['signature'] = $this->sign($queryParams);

        try {
            $response = $this->client->request('GET', '/fapi/v1/userTrades', [
                'headers' => [
                    'X-MBX-APIKEY' => $this->apiKey,
                ],
                'query' => $queryParams,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Error fetching Binance futures account trade list: ' . $e->getMessage());
            return null;
        }
    }

    public function getFuturesAccountTradeSummary($symbol, $orderid)
    {

        $this->client = new Client(['base_uri' => $this->futureBaseUri]);

        $queryParams = [
            'symbol' => $symbol,
            'orderId' => $orderid,
            'recvWindow' => $this->recvWindow,
            'timestamp' => time() * 1000,
        ];

        // Signature
        $queryParams['signature'] = $this->sign($queryParams);

        try {
            $response = $this->client->request('GET', '/fapi/v1/userTrades', [
                'headers' => [
                    'X-MBX-APIKEY' => $this->apiKey,
                ],
                'query' => $queryParams,
            ]);

            $result = json_decode($response->getBody(), true);

            $pnl = 0;
            $quoteQty = 0;
            $commission = 0;
            $pnlPercent = 0;

            foreach ($result as $trade) {
                $pnl += floatval($trade["realizedPnl"]);
                $quoteQty += floatval($trade["quoteQty"]);
                $commission += floatval($trade["commission"]);
            }

            $pnl = $pnl - $commission;
            if ($pnl < 0) {
                $before = $quoteQty + abs($pnl);
                $pnlPercent = ($before / 100) * $pnl;
            } else {
                $pnlPercent = ($quoteQty / 100) * $pnl;
            }
            $pnl = number_format($pnl, 2, '.', '');
            $pnlPercent = number_format($pnlPercent, 2, '.', '');
            $commission_asset = $result[0]["commissionAsset"];
            $human_time = \Carbon\Carbon::createFromTimestampMs($result[0]["time"])->format('Y-m-d H:i');
            return [
                "pnl" => $pnl,
                "pnl_percent" => $pnlPercent,
                "symbol" => $symbol,
                "commission_asset" => $commission_asset,
                "human_time" => $human_time,
                "reserve_ulid" => \Illuminate\Support\Str::ulid()
            ];
        } catch (\Exception $e) {
            Log::error('Error fetching Binance futures account trade list: ' . $e->getMessage());
            print_r($e->getMessage());
            return null;
        }
    }

    public function asset()
    {

        $this->client = new Client(['base_uri' => $this->baseUri]);

        $queryParams = [
            'recvWindow' => $this->recvWindow,
            'timestamp' => time() * 1000,
        ];

        // Signature
        $queryParams['signature'] = $this->sign($queryParams);

        try {
            $response = $this->client->request('GET', '/api/v3/account', [
                'headers' => [
                    'X-MBX-APIKEY' => $this->apiKey,
                ],
                'query' => $queryParams,
            ]);

            $result = json_decode($response->getBody(), true);
            return $result['balances'];
        } catch (\Exception $e) {
            Log::error('Error fetching Binance check account: ' . $e->getMessage());
            return false;
        }
    }

    protected function sign($params)
    {
        return hash_hmac('sha256', http_build_query($params), $this->apiSecret);
    }
}
