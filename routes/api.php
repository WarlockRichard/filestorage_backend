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

Route::get('files', 'FileController@index');
Route::get('files/find/{id}', 'FileController@find');
Route::delete('files/{id}', 'FileController@destroy');
Route::post('files/store', 'FileController@store');


Route::get('user', 'AuthController@getUser');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
