<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DistrictController@index');

Route::group(['prefix' => 'districts'], function () {
    Route::get('/', 'DistrictController@index');
    Route::post('/', 'DistrictController@store');
    Route::get('/new', 'DistrictController@create');
    Route::get('/{id}', 'DistrictController@show');
    Route::get('/{id}/theaters/new', 'TheaterController@new');
    Route::post('/{id}/theaters', 'TheaterController@webStore');
});
