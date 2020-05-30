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

Route::group(['prefix' => 'auth', 'namespace' => 'Api\Auth'], function () {
    Route::post('Register', 'RegisterController@register');
    Route::post('Register/Admin', 'RegisterController@registerAdmin');
    Route::post('Register/Blogger', 'RegisterController@registerBlogger');
    Route::post('login', 'LoginController@login');
});


Route::group(['prefix' => 'product', 'middleware' => ['auth:api']], function () {

    Route::get('/all', 'ProductController@index');
    Route::get('/{id}', 'ProductController@show');

});


Route::group(['prefix' => 'user', 'middleware' => ['auth:api']], function () {

    Route::get('details', 'UsersController@getDetailsUser');
    Route::get('products', 'UsersController@getProductUser');
    Route::get('show/user/by/{id}', 'UsersController@show');
    Route::post('/store/Order', 'OrderController@store');

});


Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    Route::get('show/all/user', 'UsersController@index');
    Route::get('show/all/product', 'ProductController@index');
    Route::get('/details', 'UsersController@getDetailsAdmins');
    Route::get('/show/user/by/{id}', 'UsersController@show');
    Route::get('/show/product/by/{id}', 'ProductController@show');
    Route::delete('/soft/delete/product/{id}', 'ProductController@destroy');
    Route::delete('/delete/order/{id}', 'OrderController@destroy');
    Route::get('/deleted/product', 'ProductController@getDeletedProduct');
    Route::get('/show/order', 'OrderController@index');
    Route::delete('/Force/delete/product/{id}', 'ProductController@destroyForce');
    Route::post('/store/product', 'ProductController@store');
    Route::post('/update/product/{id}', 'ProductController@update');
    Route::post('/update/state/order/{id}', 'OrderController@update');
});
