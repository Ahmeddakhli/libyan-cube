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


Route::group(['namespace' => 'Api'], function() {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function() {
        Route::group(['middleware' => ['auth:api', 'HasEventsModule']], function() {
            Route::group(['prefix' => 'events'], function() {
                Route::get('/', 'EventsController@index');
                Route::post('store', 'EventsController@store');
                Route::post('update', 'EventsController@update');
                Route::post('delete', 'EventsController@delete');
            });
        });
    });
});