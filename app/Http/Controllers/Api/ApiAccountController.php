<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rules\EthVerifySignatureRules;
use App\Rules\UsernameRules;
use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Models\Wallet;
use App\Repositories\Eloquent\WalletRepository;
use App\Services\BinanceService;

class ApiAccountController extends Controller
{
    use ApiResponseTrait;

    function create_account(Request $request)
    {
        $rules = [
            'display_name' => 'required|min:3',
            'username' => ['required', 'min:4', 'unique:wallets,wallet_username', new UsernameRules()],
            'address' => 'required',
            'signature' => 'required',
            // 'message' => ['required', new EthVerifySignatureRules($request->address, $request->signature)],
            'message' => 'required',
        ];

        $request->validate($rules);
        $payload = [
            ...$request->all(),
            'wallet_address' => $request->address,
            'wallet_name' => $request->display_name,
            'wallet_username' => $request->username,
        ];

        try {
            $result = app(WalletRepository::class)->create($payload);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success([], 'Account created successfully');
    }


    function edit_avatar(Request $request)
    {
        $rules = [
            'avatar' => ['integer', 'required'],
            'wallet' => ['required', 'exists:wallets,wallet_address'],
            'signature' => 'required',
        ];

        $request->validate($rules);


        try {
            $wallet = Wallet::where('wallet_address', $request->wallet)->first();
            $payload = [
                'wallet_avatar' => $request->avatar,
            ];

            $result = app(WalletRepository::class)->update($wallet->id, $payload);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success([], 'Avatar has been updated');
    }

    function edit_profile(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'username' => ['required', 'min:4', new UsernameRules()],
            'wallet' => ['required', 'exists:wallets,wallet_address'],
            'signature' => 'required',
        ];

        $request->validate($rules);

        try {
            $wallet = Wallet::where('wallet_address', $request->wallet)->first();
            $payload = [
                'wallet_username' => $request->username,
                'wallet_name' => $request->name,
            ];

            $result = app(WalletRepository::class)->update($wallet->id, $payload);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success([], 'Profile has been updated');
    }


    function edit_api(Request $request)
    {
        $rules = [
            'api_key' => 'required',
            'api_key' => 'required',
            'wallet' => ['required', 'exists:wallets,wallet_address'],
            'signature' => 'required',
        ];

        $request->validate($rules);

        try {
            $wallet = Wallet::where('wallet_address', $request->wallet)->first();
            $payload = [
                'wallet_api_key' => $request->api_key,
            ];

            $result = app(WalletRepository::class)->update($wallet->id, $payload);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success([], 'API key has been updated');
    }


    function edit_binance_api(Request $request)
    {
        $rules = [
            'wallet_binance_api_key' => 'required',
            'wallet_binance_api_secret' => 'required',
        ];

        $request->validate($rules);

        try {
            $wallet = Wallet::where('wallet_address', $request->wallet)->first();

            $binance = new BinanceService($request->wallet_binance_api_key, $request->wallet_binance_api_secret);
            $binance_account = $binance->account();            

            if(!$binance_account) return $this->error('Invalid API key', 400);

            $payload = [
                'wallet_binance_api_key' => $request->wallet_binance_api_key,
                'wallet_binance_api_secret' => $request->wallet_binance_api_secret,
                'wallet_binance_api_status' => 1
            ];
            $result = app(WalletRepository::class)->update($wallet->id, $payload);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success([], 'API key has been updated');
    }
}
