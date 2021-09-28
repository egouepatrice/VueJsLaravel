<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})->name('username');
*/

Route::group([
    'prefix' => 'v1'
], function (){

    Route::group([
        'prefix' => 'entity'
    ], function (){

        Route::get('list', 'Api\V1\EntityController@index')->name("api.v1.entity.list");
        Route::post('create', 'Api\V1\EntityController@create')->name("api.v1.entity.create");
        Route::post('update/{entity_id}', 'Api\V1\EntityController@update')->name("api.v1.entity.update");
        Route::get('delete/{entity_id}', 'Api\V1\EntityController@delete')->name("api.v1.entity.delete");
    });
});
