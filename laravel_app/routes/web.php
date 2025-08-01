<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\TimeLienController;
use App\Http\Controllers\TimeLineController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\\Http\\Controllers\\MemoController@show');
    Route::post('/add', 'App\\Http\\Controllers\\MemoController@add');
    Route::post('/delete', 'App\\Http\\Controllers\\MemoController@delete');
    Route::get('edit/{edit_id}', 'App\\Http\\Controllers\\MemoController@getEdit');
    Route::post('update', 'App\\Http\\Controllers\\MemoController@postEdit');
    Route::get('/timeline', [TimeLineController::class, 'show']);
    Route::get('/user_profile/{user_id}', [UserProfileController::class, 'show']);
    // フォロー解除
    Route::post('/unfollow/{id}', [UserProfileController::class, 'unfollowUser'])->name('unfollow');
    // フォロー
    Route::post('/follow/{id}', [UserProfileController::class, 'followUser'])->name('follow');
});
