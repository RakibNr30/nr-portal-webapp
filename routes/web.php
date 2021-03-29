<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('admin.layouts.master');
});*/

Auth::routes(['verify' => true]);

Route::get('register', function () {
    abort(404);
});
Route::get('password/reset', function () {
    abort(404);
});

Route::group(['middleware' => ['auth:web']], function () {
	Route::get('/notifications', 'NotificationController@all_notifications')->name('all.notifications');
});
