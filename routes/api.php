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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('files', 'FileController', ["only" => ['index', 'show', 'destroy', 'store']]);


Route::get('user', 'AuthController@getUser');
Route::post('auth/login', 'AuthController@login');
Route::post('auth/verify', 'AuthController@verify');
Route::post('auth/logout', 'AuthController@logout');
