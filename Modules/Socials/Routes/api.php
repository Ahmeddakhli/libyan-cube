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
        Route::group(['middleware' => ['auth:api', 'HasSocialsModule']], function () {
            Route::group(['prefix' => 'socials'], function () {
                Route::get('/', 'SocialsController@index');
                Route::post('store', 'SocialsController@store');
                Route::post('update', 'SocialsController@update');
                Route::post('delete', 'SocialsController@delete');
            });
        });
    });
});
