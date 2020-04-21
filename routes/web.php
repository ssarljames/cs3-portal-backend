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
// use App\Models\StationUsageLog;
// use Carbon\Carbon;

// use App\Models\AccessToken;

use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Route::get('', function(){

//     $max = Carbon::parse(date('Y-m-d') . ' ' . StationUsageLog::MAX_TIME_OUT);


//     return $max->lte('2020-03-30 20:26:00') ? '1' : '0';
// });


// Route::get('login', function(){
//     return 'Test login';
// })->name('login');

Route::get('share/posts/{post}', function(Post $post){

    $url = "posts/" . $post->id;
    $title = $post->title;
    $description = "Posted by " . $post->user->fullname . " at " . $post->created_at->format('M d, Y');

    return view('meta', compact('title', 'description', 'url'));
});