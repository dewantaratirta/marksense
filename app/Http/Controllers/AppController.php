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
        return Inertia::render('AppPage',[
            'title' => 'Explore - ' . config('variables.templateName'),
            'description' => 'Explore - ' . config('variables.templateName'),
        ]);
    }

    public function create_account()
    {
        return Inertia::render(
            'CreateAccountPage',
            [
                'token' => csrf_token(),
                'api_url' => route('api.account.create'),
                'title' => 'Sign Up - ' . config('variables.templateName'),
                'description' => 'Sign Up - ' . config('variables.templateName'),
            ]
        );
    }

    public function profile($wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $wallet->addView();
        $wallet->addPopularities();
        return Inertia::render('ProfilePage', [
            'wallet' => $wallet,
            'title' => $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'description' => $wallet->wallet_name . ' - ' . config('variables.templateName'),
        ]);
    }
}
