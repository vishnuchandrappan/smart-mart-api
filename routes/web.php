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

Route::get('/', 'PagesController@index');

Route::group(['prefix' => 'districts'], function () {
    Route::get('/', 'DistrictController@index');
    Route::post('/', 'DistrictController@store');
    Route::get('/new', 'DistrictController@create');
    Route::get('/{id}', 'DistrictController@show');
    Route::get('/{id}/edit', 'DistrictController@webEdit');
    Route::put('/{id}', 'DistrictController@webUpdate');
    Route::delete('/{id}', 'DistrictController@webDelete');
    Route::get('/{id}/super-markets/new', 'SuperMarketController@new');
    Route::post('/{id}/super-markets', 'SuperMarketController@webStore');
});

Route::group(['prefix' => 'super-markets'], function () {
    Route::get('/{id}', 'SuperMarketController@webShow');
    Route::delete('/{id}', 'SuperMarketController@webDelete');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@webIndex');
    Route::delete('/{id}', 'UserController@webDestroy');
});

Route::group(['prefix' => 'inventory'], function () {
    Route::get('/', 'PagesController@inventory');
    Route::delete('/{user_id}', 'UserController@webDestroy');
});

Route::group(['prefix' => 'labels'], function () {
    Route::get('/', 'LabelController@index');
    Route::post('/', 'LabelController@create');
    Route::delete('/{id}', 'LabelController@delete');
    Route::get('/{id}/edit', 'LabelController@edit');
    Route::put('/{id}', 'LabelController@update');
});
