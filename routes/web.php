<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use App\Models\ServiceRate;
use App\Models\StationUsageLog;
use Carbon\Carbon;

use App\Models\AccessToken;
use Illuminate\Support\Facades\Route;

Route::get('', function(){

    $max = Carbon::parse(date('Y-m-d') . ' ' . StationUsageLog::MAX_TIME_OUT);


    return $max->lte('2020-03-30 20:26:00') ? '1' : '0';
});


Route::get('login', function(){
    return 'Test login';
})->name('login');
