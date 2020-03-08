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
        Route::resource('printers', 'PrinterController')->except('create');
        Route::resource('print-transactions', 'PrintTransactionController')->except('create');
        Route::resource('paper-sizes', 'PaperSizeController')->except('create');
        Route::resource('print-qualities', 'PrintQualityController')->except('create');
        Route::resource('print-rates', 'PrintRateController')->except('create');

        // Route::post('logout', 'AuthController@logout');
    });


});
