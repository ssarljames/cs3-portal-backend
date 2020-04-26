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
        
        Route::apiResource('users', 'UserController');
        Route::apiResource('stations', 'StationController');
        Route::apiResource('paper-sizes', 'PaperSizeController');
        Route::apiResource('print-qualities', 'PrintQualityController');
        Route::apiResource('service-rates', 'ServiceRateController');

        Route::apiResource('service-transactions', 'ServiceTransactionController');

        Route::apiResource('station-usage-logs', 'StationUsageLogController');

        Route::apiResource('posts', 'PostController')->except(['index', 'show']);


        Route::apiResource('events/{event}/event-time-logs', 'EventTimeLogController');

        Route::apiResource('events', 'EventController')->except(['index', 'show']);

        Route::apiResource('students', 'StudentController')->except(['index', 'show']);



        // Route::post('logout', 'AuthController@logout');
    });


    Route::apiResource('posts', 'PostController')->only(['index', 'show']);
    Route::apiResource('events', 'EventController')->only(['index', 'show']);
    Route::apiResource('students', 'StudentController')->only(['index', 'show']);


});
