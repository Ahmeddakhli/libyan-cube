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
        Route::group(['middleware' => ['auth:api', 'HasInternationalizationsModule']], function() {
            Route::group(['prefix' => 'internationalizations'], function() {
                Route::group(['prefix' => 'countries'], function() {
                    Route::get('countries', 'CountriesController@countries');
                    Route::get('countryCodes', 'CountriesController@countryCodes');
                    Route::get('getCountryNameByCountryCode', 'CountriesController@getCountryNameByCountryCode');
                });
                Route::group(['prefix' => 'currencies'], function() {
                    Route::get('currencies', 'CurrenciesController@currencies');
                    Route::get('currencyCodes', 'CurrenciesController@currencyCodes');
                    Route::get('getCurrencyNameByCurrencyCode', 'CurrenciesController@getCurrencyNameByCurrencyCode');
                });
            });
        });
    });
});