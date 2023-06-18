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
        Route::group(['middleware' => ['auth:api', 'HasLocationsModule']], function () {
            Route::group(['prefix' => 'locations'], function () {
                Route::get('getCountries', 'LocationsController@getCountries');
                Route::get('getCountryRegions', 'LocationsController@getCountryRegions');
                Route::get('getRegionCities', 'LocationsController@getRegionCities');
                Route::get('getCityAreas', 'LocationsController@getCityAreas');
                Route::get('getCountryById', 'LocationsController@getCountryById');
                Route::get('getRegionById', 'LocationsController@getRegionById');
                Route::get('getCityById', 'LocationsController@getCityById');
                Route::post('store', 'LocationsController@store');
                Route::post('update', 'LocationsController@update');
                Route::post('delete', 'LocationsController@delete');
            });
        });
    });
});
