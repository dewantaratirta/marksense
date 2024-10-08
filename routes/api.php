<?php

use Illuminate\Support\Facades\Route;

// public
Route::group(['middleware' => 'web', 'prefix' => 'public', 'as' => 'api.public.'], function () {

});

Route::group(['prefix' => 'account', 'as' => 'api.account.'], function () {

    Route::post('/create', [App\Http\Controllers\Api\ApiAccountController::class, 'create_account'])
    ->middleware(['web'])
    ->name('create');

    Route::post('edit_avatar/{wallet}', [App\Http\Controllers\Api\ApiAccountController::class, 'edit_avatar'])
    ->middleware(['web'])
    ->name('edit_avatar');

    Route::post('edit_profile/{wallet}', [App\Http\Controllers\Api\ApiAccountController::class, 'edit_profile'])
    ->middleware(['web'])
    ->name('edit_profile');

    Route::post('edit_api/{wallet}', [App\Http\Controllers\Api\ApiAccountController::class, 'edit_api'])
    ->middleware(['web'])
    ->name('edit_api');
});
