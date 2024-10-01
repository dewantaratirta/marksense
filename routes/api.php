<?php

use Illuminate\Support\Facades\Route;

// public
Route::group(['middleware' => 'web', 'prefix' => 'public', 'as' => 'api.public.'], function () {

});
