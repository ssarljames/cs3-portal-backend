<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {

    Route::post('login', 'AuthController@login')->name('login.api');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('users', 'UserController')->except('create');
        Route::resource('stations', 'StationController')->except('create');
        Route::resource('paper-sizes', 'PaperSizeController')->except('create');
        Route::resource('print-qualities', 'PrintQualityController')->except('create');
        Route::resource('service-rates', 'ServiceRateController')->except('create');

        Route::resource('service-transactions', 'ServiceTransactionController')->except('create');

        Route::resource('station-usage-logs', 'StationUsageLogController')->except('create');

        Route::resource('posts', 'PostController')->except(['index', 'show','create']);

        // Route::post('logout', 'AuthController@logout');
    });


    Route::resource('posts', 'PostController')->only(['index', 'show']);


});
