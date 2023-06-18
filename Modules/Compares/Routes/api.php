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
        Route::group(['middleware' => ['HasComparesModule']], function () {
            Route::group(['prefix' => 'compares'], function () {
                Route::get('/', 'ComparesController@index');
                Route::post('store', 'ComparesController@store');
                Route::post('delete', 'ComparesController@delete');
            });
        });
        Route::group(['middleware' => ['auth:api', 'HasComparesModule']], function () {
            Route::group(['prefix' => 'compares'], function () {
                Route::post('update', 'ComparesController@update');
            });
        });
    });
});
