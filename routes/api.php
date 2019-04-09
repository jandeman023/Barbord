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

Route::get('v1/users', 'UserController@index');
Route::get('v1/products', 'ProductController@index');
Route::get('v1/products/{id}', 'ProductController@show');
Route::get('v1/groups', 'GroupController@index');
Route::get('v1/groups/{id}', 'GroupController@show');
Route::post('v1/orders', 'OrderController@store');