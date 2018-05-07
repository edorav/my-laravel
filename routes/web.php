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
    Route::get('/my-profile', 'UserController@show')->name('myprofile');
    Route::post('/edit', 'UserController@update')->name('edit-profile');
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

Route::group(['prefix' => 'roles'], function(){
    Route::get('/', 'RoleController@index')->name('index-agency');
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

Route::group(['prefix' => 'friendship'], function(){
    Route::get('/', 'FriendshipController@index')->name('index-agency');
    Route::get('/create', 'FriendshipController@create')->name('create-friendship');
    Route::post('/', 'FriendshipController@store')->name('store-friendship');

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

Route::get('/testimg', function()
{
    $img = Storage::get('public/file.jpg');

    $filename  = time() . '.jpg';
		$path = storage_path( 'app/public/' . $filename);
    $imgResized = Image::make($img)->resize(300, 200)->save($path);
    return $imgResized->response('jpg');
});

Route::group(['middleware' => ['role:super-admin'],'prefix' => 'superadmin'], function () {
    Route::get('/', 'RoleController@index')->name('index-agency');
});
