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
Route::group(['prefix' => 'v1/', 'middleware' => 'client'], function () {
    /*Routes Admin*/
    Route::group(['prefix' => 'admin', 'namespace' => 'Api\V1\Admin'], function () {
        /*util*/
        Route::get('youvita/estoque/{id}', 'YouvitaController@getStock');
        Route::get('youvita/status', 'YouvitaController@getStatus');
    });
});

Route::group(['prefix' => 'v1/', 'middleware' => 'auth:api'], function () {
    /*Routes Admin*/
    Route::group(['prefix' => 'admin', 'namespace' => 'Api\V1\Admin'], function () {
        /*util*/
        Route::get('cnpj/{cnpj}', 'UtilController@getCnpj');
        Route::get('cep/{cep}', 'UtilController@getCep');
        Route::get('emitir', 'UtilController@emitirNfe');
        Route::get('consulta/{recibo}', 'UtilController@consultaProtocolo');
        Route::get('danfe', 'UtilController@emitirDanfe');
        Route::get('comprovei', 'ComproveiController@index');
        Route::get('report', 'UtilController@reports');
        Route::get('report/compras', 'UtilController@getReportCompras');
        Route::get('report/compras/export', 'UtilController@exportCompras');
        Route::get('report/gnre', 'UtilController@getGnre');
        Route::get('comprovei/agent', 'ComproveiController@getAgents');
        Route::get('comprovei/send', 'ComproveiController@sendComprovei');
        Route::delete('file/delete/{image}/{folder}', 'UtilController@deleteFile');

        /*Notas fiscais*/
        Route::get('notas','NotaFiscalController@index');

        /*Users*/
        Route::post('user', 'UserController@store');
        Route::post('user/upload', 'UserController@upload');
        Route::get('authenticated', 'UserController@authenticated');
        Route::get('user', 'UserController@index');
        Route::get('user/{id}', 'UserController@edit');
        Route::put('user/{id}', 'UserController@update');
        Route::delete('user/{id}', 'UserController@delete');
        Route::patch('user/{id}', 'UserController@updateStatus');
        Route::patch('user/password/{id}', 'UserController@updatePassword');

        Route::get('protocol', 'ProtocolsController@index');
        Route::get('protocol/{id}', 'ProtocolsController@getProtocols');

        /*Stock*/
        Route::post('stock', 'StocksController@store');
        Route::get('stock/{id}', 'StocksController@index');
        Route::get('stock', 'StocksController@groupStocks');
        Route::get('chave', 'StocksController@getChave');
        Route::get('stock/all/{id}', 'StocksController@getAll');
        Route::post('stock/export', 'StocksController@export');
        Route::put('stock/{id}', 'StocksController@update');

        /*Road*/
        Route::post('road', 'RoadController@store');
        Route::get('road/{id}', 'RoadController@index');
        Route::get('road/filter/{id}', 'RoadController@filterData');
        Route::get('road', 'RoadController@find');
        Route::get('road/all/{id}', 'RoadController@getAll');
        Route::post('road/export', 'RoadController@export');
        Route::put('road/{id}', 'RoadController@update');

        /*Outs*/
        Route::post('out', 'OutsController@store');
        Route::get('out/{id}', 'OutsController@index');
        Route::get('out/filter/{id}', 'OutsController@filterData');
        Route::get('out/all/{id}', 'OutsController@getAll');
        Route::post('out/export', 'OutsController@export');
        //Route::get('out/{id}', 'OutsController@edit');
        Route::put('out/{id}', 'OutsController@update');

        /*Company*/
        Route::post('company', 'CompaniesController@store');
        Route::post('company/upload', 'CompaniesController@upload');
        Route::get('company', 'CompaniesController@index');
        Route::get('company/{id}', 'CompaniesController@edit');
        Route::put('company/{id}', 'CompaniesController@update');

        /*News*/
        Route::post('news', 'NewsController@store');
        Route::post('news/upload', 'NewsController@upload');
        Route::get('news', 'NewsController@index');
        Route::get('news/{id}', 'NewsController@edit');
        Route::put('news/{id}', 'NewsController@update');
        /*Extensions*/
        Route::post('extension', 'ExtensionsController@store');
        Route::post('extension/upload', 'ExtensionsController@upload');
        Route::get('extension', 'ExtensionsController@index');
        Route::get('extension/{id}', 'ExtensionsController@edit');
        Route::put('extension/{id}', 'ExtensionsController@update');
    });
});
