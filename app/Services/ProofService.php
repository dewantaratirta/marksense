<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ProofService
{
    protected $apiKey;
    protected $apiSecret;
    protected $baseUri = 'https://ms.blocknaut.xyz';
    protected $client;

    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    public function getAssetProof($asset)
    {
        $client = new Client(['base_uri' => $this->baseUri]);
        $data = [
            "api_key" => $this->apiKey,
            "api_secret" => $this->apiSecret,
            "asset" => $asset
        ];

        try {
            $response = $client->post("/generateAssetProof", [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);

            return [
                'status' => $statusCode,
                'data' => $responseData
            ];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return [
                'status' => 400,
                'data' => "error create proof"
            ];
        }
    }

    public function getFutureProof($symbol, $orderId)
    {
        $client = new Client(['base_uri' => $this->baseUri]);
        $data = [
            "api_key" => $this->apiKey,
            "api_secret" => $this->apiSecret,
            "symbol" => $symbol,
            "order_id" => $orderId
        ];

        try {
            $response = $client->post("/generateUSDMTradeProof", [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);
            return [
                'status' => $statusCode,
                'data' => $responseData
            ];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error($e->getMessage());
            return [
                'status' => 400,
                'data' => $e->getMessage()
            ];
        }
    }
}
