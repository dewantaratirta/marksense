<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'IndexPage',
            // [
            //     'token' => csrf_token(),
            // ]
        );
    }

    public function app()
    {
        return Inertia::render('AppPage');
    }

    public function create_account()
    {
        return Inertia::render('CreateAccountPage',
            [
                'token' => csrf_token(),
                'api_url' => route('api.account.create'),
            ]
        );
    }

    public function profile($wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if(!$wallet) return redirect()->route('app.index');

        return Inertia::render('ProfilePage', [
            'wallet' => $wallet
        ]);
    }
}
