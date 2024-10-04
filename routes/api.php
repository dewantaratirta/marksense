<?php

use Illuminate\Support\Facades\Route;

// public
Route::group(['middleware' => 'web', 'prefix' => 'public', 'as' => 'api.public.'], function () {

});

Route::group(['prefix' => 'account', 'as' => 'api.account.'], function () {

    Route::post('/create', [App\Http\Controllers\Api\ApiAccountController::class, 'create_account'])
    ->middleware(['web'])
    ->name('create');
});
