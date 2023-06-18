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
        Route::group(['middleware' => ['auth:api', 'HasSeoModule']], function () {
            Route::group(['prefix' => 'seo'], function () {
                Route::get('/', 'SeoController@index');
                Route::post('store', 'SeoController@store');
                Route::post('update', 'SeoController@update');
                Route::post('delete', 'SeoController@delete');
                Route::post('apply', 'SeoController@apply');
            });
        });
    });
});
