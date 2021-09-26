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

Route::group([
    'prefix' => "app/users",
    'namespace' => "Api\V1\UserManager",
    //'middleware' => 'foo'
], function () {
    Route::get('', 'UsersController@users')->name('users.all');
    Route::get('{id}', 'UsersController@user')->name('users.id');
    Route::get('{id}/actions', 'UsersController@user_actions')->name('users.id.actions');
    Route::get('search/customer', 'UsersController@user_search')->name('users.search');
});
