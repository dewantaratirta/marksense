<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rules\EthVerifySignatureRules;
use App\Rules\UsernameRules;
use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Repositories\Eloquent\WalletRepository;

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
            'message' => ['required', new EthVerifySignatureRules($request->address, $request->signature)],
        ];

        $request->validate($rules);
        $payload = [
            ...$request->all(),
            'wallet_address' => $request->address,
            'wallet_name' => $request->display_name,
            'wallet_username' => $request->username,
        ];

        try{
            $result = app(WalletRepository::class)->create($payload);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }

        return $this->success([], 'Account created successfully');
    }
}
