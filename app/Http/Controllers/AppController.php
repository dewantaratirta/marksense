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
        return Inertia::render('AppPage', [
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

        $wallet->avatar_url = $wallet->getAvatarUrl();
        return Inertia::render('ProfilePage', [
            'wallet' => $wallet,
            'title' => $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'description' => $wallet->wallet_name . ' - ' . config('variables.templateName'),
        ]);
    }

    public function profile_edit($wallet)
    {
        $wallet = Wallet::where('wallet_address', $wallet)->first();
        if (!$wallet) return redirect()->route('app.create_account');

        $wallet->avatar_url = $wallet->getAvatarUrl();
        return Inertia::render('EditProfilePage', [
            'wallet' => $wallet,
            'token' => csrf_token(),
            'title' => 'Edit Profile - ' . $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'description' => 'Edit Profile - ' . $wallet->wallet_name . ' - ' . config('variables.templateName'),
            'edit_avatar_url' => route('api.account.edit_avatar', ['wallet' => $wallet->wallet_address]),
        ]);
    }
}
