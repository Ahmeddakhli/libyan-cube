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
        Route::group(['middleware' => ['auth:api', 'HasRatingsModule']], function () {
            Route::group(['prefix' => 'ratings'], function () {
                Route::get('/', 'RatingsController@index');
                Route::post('store', 'RatingsController@store');
                Route::post('update', 'RatingsController@update');
                Route::post('delete', 'RatingsController@delete');
            });
        });
    });
});
