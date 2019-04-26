<?php
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

Route::group(['prefix' => 'v1/', 'middleware' => 'auth:api'], function () {
    /*Routes Admin*/
    Route::group(['prefix' => 'admin', 'namespace' => 'Api\V1\Admin'], function () {
        /*util*/
        Route::get('cnpj/{cnpj}', 'UtilController@getCnpj');
        Route::get('cep/{cep}', 'UtilController@getCep');

        /*Users*/
        Route::post('user', 'UserController@store');
        Route::get('authenticated', 'UserController@authenticated');
        Route::get('user', 'UserController@index');
        Route::get('user/{id}', 'UserController@edit');
        Route::put('user/{id}', 'UserController@update');
        Route::delete('user/{id}', 'UserController@delete');
        Route::patch('user/{id}', 'UserController@updateStatus');

        /*Stock*/
        Route::post('stock', 'StocksController@store');
        Route::get('stock', 'StocksController@index');
        Route::get('stock/all', 'StocksController@getAll');
        Route::get('stock/export', 'StocksController@export');
        Route::get('stock/{id}', 'StocksController@edit');
        Route::put('stock/{id}', 'StocksController@update');

        /*Road*/
        Route::post('road', 'RoadController@store');
        Route::get('road', 'RoadController@index');
        Route::get('road/all', 'RoadController@getAll');
        Route::get('road/export', 'RoadController@export');
        Route::get('road/{id}', 'RoadController@edit');
        Route::put('road/{id}', 'RoadController@update');

        /*Outs*/
        Route::post('out', 'OutsController@store');
        Route::get('out', 'OutsController@index');
        Route::get('out/all', 'OutsController@getAll');
        Route::get('out/export', 'OutsController@export');
        Route::get('out/{id}', 'OutsController@edit');
        Route::put('out/{id}', 'OutsController@update');

        /*Company*/
        Route::post('company', 'CompaniesController@store');
        Route::get('company', 'CompaniesController@index');
        Route::get('company/{id}', 'CompaniesController@edit');
        Route::put('company/{id}', 'CompaniesController@update');
    });
});
