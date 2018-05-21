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

/*
 GET	/photos	index	photos.index
 GET	/photos/create	create	photos.create
 POST	/photos	store	photos.store
 GET	/photos/{photo}	show	photos.show
 GET	/photos/{photo}/edit	edit	photos.edit
 PUT/PATCH	/photos/{photo}	update	photos.update
 DELETE	/photos/{photo}	destroy	photos.destroy
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user'], function () {
    Auth::routes();
    Route::get('/my-profile', 'UserController@show')->name('myprofile');
    Route::post('/edit', 'UserController@update')->name('edit-profile');
    Route::get('/my-trips', 'UserController@showMyTrip')->name('mytrips');
});

Route::group(['prefix' => 'friendship'], function () {
    Route::get('/create', 'FriendshipController@create')->name('create-friendship');
    Route::post('/', 'FriendshipController@store')->name('store-friendship');
});

Route::group(['prefix' => 'trip'], function () {
    Route::get('/create', 'TripController@create')->name('create-trip');
    Route::post('/', 'TripController@store')->name('create-trip');
    Route::get('/{id}', 'TripController@show')->name('detail-trip');
    //Route::post('/', 'FriendshipController@store')->name('store-trip');
   // Route::get('/search', 'FriendshipController@showLoggedUserFriends')->name('get-friendships-list-by-search');
});

/*
Route::group(['prefix' => 'agency'], function(){
    Route::get('/', 'AgencyController@index')->name('index-agency');
    Route::get('/create', 'AgencyController@create')->name('create-agency');
    Route::post('/', 'AgencyController@store')->name('store-agency');
});

Route::group(['prefix' => 'roles'], function(){
    Route::get('/', 'RoleController@index')->name('index-agency');
    Route::get('/create', 'AgencyController@create')->name('create-agency');
    Route::post('/', 'AgencyController@store')->name('store-agency');
});
*/
/*
Route::group(['middleware' => ['role:super-admin'],'prefix' => 'superadmin'], function () {
    Route::get('/', 'RoleController@index')->name('index-agency');
});
*/
