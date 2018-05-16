<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:api'],'prefix' => 'trip'], function(){
    //Route::get('/create', 'TripController@create')->name('create-trip');
    //Route::post('/', 'TripController@store')->name('store-trip');
    Route::get('/search', 'FriendshipController@showLoggedUserFriends')->name('get-friendships-list-by-search');
});