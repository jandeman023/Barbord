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
Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {
    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::patch('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@destroy');

    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::patch('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');

    Route::get('groups', 'GroupController@index');
    Route::get('groups/{id}', 'GroupController@show');

    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@store');

    Route::get('payment', 'PaymentController@index');
    Route::post('payment', 'PaymentController@store');
    
    Route::get('statusupdatemail', 'StatusUpdateMailController@index');
});;

Route::group([
    'prefix' => 'v1/auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
