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
        Route::group(['middleware' => ['auth:api', 'HasContactUsModule']], function() {
            Route::group(['prefix' => 'contact_us'], function() {
                Route::get('/', 'ContactUSController@index');
                Route::post('store', 'ContactUSController@store');
                Route::post('update', 'ContactUSController@update');
                Route::post('delete', 'ContactUSController@delete');
            });
            Route::group(['prefix' => 'subscribes'], function() {
                Route::get('/', 'SubscribesController@index');
                Route::post('store', 'SubscribesController@store');
                Route::post('update', 'SubscribesController@update');
                Route::post('delete', 'SubscribesController@delete');
            });
        });
    });
});