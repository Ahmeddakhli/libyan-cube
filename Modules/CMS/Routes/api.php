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

Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function () {
        Route::group(['middleware' => ['auth:api', 'localization']], function () {
            Route::group(['prefix' => 'cms_managements'], function () {
                Route::get('all', 'CmsManagementsController@index');
                Route::post('store', 'CmsManagementsController@store');
                Route::patch('update', 'CmsManagementsController@update');
                Route::delete('delete', 'CmsManagementsController@delete');
            });
        });
        Route::group(['middleware' => ['localization']], function () {
            Route::group(['prefix' => 'front'], function () {
                Route::group(['prefix' => 'cms_managements'], function () {
                    Route::get('all', 'CmsManagementsController@index');
                });
            });
        });
    });
});
