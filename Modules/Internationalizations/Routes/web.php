<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
    'namespace' => 'Web'
],
function()
{
    Route::group(['prefix' =>'admin', 'middleware' => ['web', 'auth','isAdmin']], function() {
        Route::prefix('internationalizations')->group(function() {
            Route::group(['middleware' => []], function() {
                Route::group(['prefix' => 'countries'], function() {
                    Route::get('countries', 'CountriesController@countries')->name('internationalizations.countries.countries');
                    Route::get('countryCodes', 'CountriesController@countryCodes')->name('internationalizations.countries.countryCodes');
                    Route::get('getCountryNameByCountryCode', 'CountriesController@getCountryNameByCountryCode')->name('internationalizations.countries.getCountryNameByCountryCode');
                });
                Route::group(['prefix' => 'currencies'], function() {
                    Route::get('currencies', 'CurrenciesController@currencies')->name('internationalizations.currencies.currencies');
                    Route::get('currencyCodes', 'CurrenciesController@currencyCodes')->name('internationalizations.currencies.currencyCodes');
                    Route::get('getCurrencyNameByCurrencyCode', 'CurrenciesController@getCurrencyNameByCurrencyCode')->name('internationalizations.currencies.getCurrencyNameByCurrencyCode');
                });
            });
        });
    });
});