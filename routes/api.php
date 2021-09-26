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
    'prefix' => 'spayxadmin',
    'middleware'=>['api_set_language','api_verify_user_integrity']], function (){

    Route::post('usrbenaccstatus', 'Api\V1\UserManager\BenAccController@userBenAccStatus')
        ->middleware(['api_verify_data:user_ben_acc_status']);

    Route::post('saveadvantage', 'Api\V1\UserManager\BenAccController@saveAdvantage')
        ->middleware(['api_verify_data:save_advantage']);
});
