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
        Route::group(['middleware' => ['auth:api', 'HasMeetingsModule']], function() {
            Route::group(['prefix' => 'meetings'], function() {
                Route::get('/', 'MeetingsController@index');
                Route::post('store', 'MeetingsController@store');
                Route::post('update', 'MeetingsController@update');
                Route::post('delete', 'MeetingsController@delete');
            });
        });
    });
});