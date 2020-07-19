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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('/verifyOTP', 'UserController@verify');
});


Route::group([
    'prefix' => 'users',
], function ($router) {
    Route::post('/', 'UserController@store');
    Route::get('/', 'UserController@index');
    Route::get('/{user_id}', 'UserController@show');
    Route::delete('/{user_id}', 'UserController@destroy');
    Route::put('/{user_id}', 'UserController@update');
});

Route::group([
    // 'middleware' => 'auth:api'
], function ($router) {
    Route::post('/forgotPassword', 'UserController@forgotPassword');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'superMarket'
], function ($router) {
    Route::get('/', 'SuperMarketController@show');
    Route::post('/', 'SuperMarketController@store');
    Route::put('/{id}', 'SuperMarketController@update');
    Route::post('/changeState', 'SuperMarketController@changeState');
});

Route::post('/admin/login', 'AuthController@adminLogin');

Route::group(['prefix' => 'items', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'ItemController@index');
    Route::post('/', 'ItemController@create');
    Route::get('/{id}', 'ItemController@stocks');
    Route::put('/{id}', 'ItemController@update');
    Route::delete('/{id}', 'ItemController@destroy');
    Route::get('/outOfStock', 'ItemController@outOfStock');
    Route::get('/lowStock', 'ItemController@lowStock');
});

Route::group(['prefix' => 'districts'], function () {
    Route::get('/{id}/superMarkets', 'DistrictController@apiShow');
    Route::get('/', 'DistrictController@apiIndex');
});


Route::group(['prefix' => 'stocks', 'middleware' => 'auth:api'], function () {
    Route::post('/', 'StockController@create');
    Route::put('/', 'StockController@update');
});

Route::group(['prefix' => 'labels', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'SuperMarketController@getLabels');
    Route::get('/{id}', 'SuperMarketController@getItems');
});


Route::post('/createAdmin', 'AuthController@createAdmin');


Route::group(['prefix' => 'user'], function () {
    Route::get('/getSuperMarkets', 'AppController@one');
    Route::get('/getSuperMarket', 'AppController@two');
    Route::get('/getItems', 'AppController@three');
    Route::get('/getItem', 'AppController@four');
    Route::post('/addToCard', 'AppController@five');
    Route::get('/cart', 'AppController@cart');
    Route::post('/removeItems','AppController@remove');
});
