<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('index');

Auth::routes([
    'register' => false,
    'reset' => false, // Password Reset Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'],)->middleware(['auth'])->name('home');


// Profile
Route::group(['prefix' => 'profile', 'middleware' => ['auth'], 'as' => 'profile.'], function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('index'); // profile.index

    Route::get('/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile_post', [App\Http\Controllers\ProfileController::class, 'profile_post'])->name('profile_post');

    Route::get('/edit_password', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit_password');
    Route::patch('/password_post', [App\Http\Controllers\ProfileController::class, 'password_post'])->name('password_post');
});

Route::group(['prefix' => 'user_management', 'middleware' => ['auth']], function () {
    // binding user.id to user.ulid
    Route::resource('/superadmin', App\Http\Controllers\Users\SuperAdminController::class)->middleware(['auth', 'role:superadmin'])->names('user_management.superadmin');
    Route::resource('/admin', App\Http\Controllers\Users\AdminController::class)->middleware(['auth', 'role:superadmin'])->names('user_management.admin');
});

// testing
Route::get('/testing123', function () {
    $x = \App\Models\User::find(1);
    $x->gender = 2;
    dd(App\Models\Enum\GenderEnum::getOptions());
});
