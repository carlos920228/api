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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('corporativos','Corporativo\CorporativoController',['except'=>['edit','create',]]);
Route::resource('corporativosPhone','Corporativo\CorporationPhonesController',['except'=>['edit','create',]]);
Route::resource('roles','Roles\RolesController',['except'=>['edit','create','destroy',]]);
Route::resource('users','User\UserController',['only'=>['show','store','index',]]);
Route::post('oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::post('login', 'User\UserController@login');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'User\UserController@details');
});
