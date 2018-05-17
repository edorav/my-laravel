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
    Route::get('/search', 'FriendshipController@showLoggedUserFriends')->name('api-get-friendships-list-by-search');
});

Route::group(['middleware' => ['auth:api'],'prefix' => 'trip'], function(){
    Route::post('/', 'TripController@store')->name('api-store-trip');
});