<?php

namespace App\Http\Controllers;

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
        return Inertia::render('CreateAccountPage');
    }

    public function profile()
    {
        return Inertia::render('ProfilePage');
    }
}
