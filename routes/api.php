<?php

use Illuminate\Support\Facades\Route;

// public
Route::group(['middleware' => 'web', 'prefix' => 'public', 'as' => 'api.public.'], function () {});

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

    Route::post('edit_api/{wallet}', [App\Http\Controllers\Api\ApiAccountController::class, 'edit_binance_api'])
        ->middleware(['web'])
        ->name('edit_binance_api');
});

Route::group(['prefix' => 'data', 'as' => 'api.data.'], function () {

    Route::get('/check', [App\Http\Controllers\Api\ApiDataController::class, 'check'])
        ->middleware(['web'])
        ->name('check');

    Route::get('/assets/{wallet}', [App\Http\Controllers\Api\ApiDataController::class, 'assets'])
        ->middleware(['web'])
        ->name('assets');

    Route::get('/futures/{wallet}', [App\Http\Controllers\Api\ApiDataController::class, 'futures'])
        ->middleware(['web'])
        ->name('future');

    Route::get('/futures_pair_list/{wallet}', [App\Http\Controllers\Api\ApiDataController::class, 'futures_pair_list'])
        ->middleware(['web'])
        ->name('futures_pair_list');

    Route::get('/futures_summary/{wallet}', [App\Http\Controllers\Api\ApiDataController::class, 'futures_summary'])
        ->middleware(['web'])
        ->name('futures_summary');
});

Route::group(['prefix' => 'proof', 'as' => 'api.proof.'], function () {

    Route::get('/asset/{wallet}', [App\Http\Controllers\Api\ApiProofController::class, 'asset'])
        ->middleware(['web'])
        ->name('assets');

    Route::post('/future/{wallet}', [App\Http\Controllers\Api\ApiProofController::class, 'future'])
        ->middleware(['web'])
        ->name('future');

    Route::get('futures/metadata/{trade_pnls}', [App\Http\Controllers\Api\ApiProofController::class, 'futures_metadata'])
        ->middleware(['web'])
        ->name('futures_metadata');
});
