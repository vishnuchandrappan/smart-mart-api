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
    'prefix' => 'admin'
], function ($router) {
    Route::get('/superMarket', 'SuperMarketController@show');
    Route::post('/superMarket', 'SuperMarketController@store');
});

Route::post('/admin/login', 'AuthController@adminLogin');
