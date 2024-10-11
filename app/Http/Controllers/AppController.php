<?php

namespace App\Http\Controllers;

use App\Models\TradePnl;
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
        # get popular wallets
        $popular_wallets = Wallet::orderBy('wallet_view', 'desc')->limit(10)->get();
        $popular_wallets->map(function ($item) {
            return $item->getPublicData();
        });

        # hottest wallets by popularity
        $hottest_wallets = Wallet::with(['popularities' => function ($query) {
            $query->where('popularity_date', '>=', \Carbon\Carbon::now()->startOfMonth())
            ->where('popularity_date', '<=', \Carbon\Carbon::now()->endOfMonth())
            ->orderBy('popularity_view', 'desc');
        }])->limit(10)->get();
        $hottest_wallets->map(function ($item) {
            return $item->getPublicData();
        });

        # get popular trades
        $popular_trades = TradePnl::orderBy('trade_pnl_view', 'desc')->with(['media'])->limit(10)->get();
        $popular_trades->map(function ($item) {
            return $item->getPublicData();
        });

        # hottest trades by popularity
        $hottest_trades = TradePnl::with(['popularities' => function ($query) {
            $query->where('popularity_date', '>=', \Carbon\Carbon::now()->startOfMonth())
            ->where('popularity_date', '<=', \Carbon\Carbon::now()->endOfMonth())
            ->orderBy('popularity_view', 'desc');
        }, 'media'])->limit(10)->get();
        $hottest_trades->map(function ($item) {
            return $item->getPublicData();
        });

        return Inertia::render('AppPage', [
            'title' => 'Explore - ' . config('variables.templateName'),
            'description' => 'Explore - ' . config('variables.templateName'),
            'popular_wallets' => $popular_wallets,
            'hottest_wallets' => $hottest_wallets,
            'popular_trades' => $popular_trades,
            'hottest_trades' => $hottest_trades,
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
        $wallet->getPublicData();

        $trade = $wallet->tradePnls()->orderBy('created_at', 'desc')->get();
        if (count($trade) > 0) {
            $trade->map(function ($item) {
                return $item->getPublicData();
            });
        }

        return Inertia::render('ProfilePage', [
            'wallet' => $wallet,
            'title' => $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'description' => $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'token' => csrf_token(),
            'trade' => $trade,
        ]);
    }

    public function profile_edit($wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $wallet->getPublicData();

        return Inertia::render('EditProfilePage', [
            'wallet' => $wallet->makeHidden(['wallet_binance_api_key', 'wallet_binance_api_secret', 'id']),
            'token' => csrf_token(),
            'title' => 'Edit Profile - ' . $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'description' => 'Edit Profile - ' . $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'edit_avatar_url' => route('api.account.edit_avatar', ['wallet' => $wallet->wallet_address]),
            'edit_profile_url' => route('api.account.edit_profile', ['wallet' => $wallet->wallet_address]),
            'edit_binance_url' => route('api.account.edit_binance_api', ['wallet' => $wallet->wallet_address]),
        ]);
    }

    public function trade(TradePnl $trade)
    {
        $wallet = $trade->wallet->getPublicData();
        $trade->addView();
        $trade->addPopularities();

        return Inertia::render('TradePage', [
            'trade' => $trade->getPublicData(),
            'wallet' => $wallet,
        ]);
    }

    function test()
    {
        return Inertia::render('TestPage');
    }
}
