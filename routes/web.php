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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'user'], function(){
    Auth::routes();
    Route::get('/my-profile', 'HomeController@showUserProfile')->name('myprofile');
});

Route::group(['prefix' => 'agency'], function(){
    Route::get('/', 'AgencyController@index')->name('index-agency');
    Route::get('/create', 'AgencyController@create')->name('create-agency');
    Route::post('/', 'AgencyController@store')->name('store-agency');
    
    /*
    GET	/photos	index	photos.index
    GET	/photos/create	create	photos.create
    POST	/photos	store	photos.store
    GET	/photos/{photo}	show	photos.show
    GET	/photos/{photo}/edit	edit	photos.edit
    PUT/PATCH	/photos/{photo}	update	photos.update
    DELETE	/photos/{photo}	destroy	photos.destroy
    */
    //Route::get('/users/create', 'AdminUserController@create');
    //Route::get('/users/{id}', 'AdminUserController@store');
});