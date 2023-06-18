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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace' => 'Web'
    ],
    function () {

        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'isAdmin']], function () {
            Route::prefix('locations')->group(function () {
                Route::group(['middleware' => []], function () {
                    Route::group(['middleware' => ['hasPermission:index-locations']], function () {
                        Route::match(['GET', 'POST'], 'index/{id?}', 'LocationsController@index')->name('locations.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-location']], function () {
                        Route::post('store', 'LocationsController@store')->name('locations.store');
                        Route::get('create', 'LocationsController@create')->name('locations.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-location']], function () {
                        Route::post('update', 'LocationsController@update')->name('locations.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-location']], function () {
                        Route::post('delete', 'LocationsController@delete')->name('locations.delete');
                    });
                    Route::group(['perfix' => 'modals'], function () {
                        Route::group(['middleware' => ['hasPermission:create-location']], function () {
                            Route::get('createLocationModal/{parent_id?}', 'LocationsController@createLocationModal')->name('locations.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-location']], function () {
                            Route::get('UpdateLocationModal/{id?}', 'LocationsController@UpdateLocationModal')->name('locations.modals.update');
                        });
                    });
                });
            });
        });
        Route::get('getCountries', 'LocationsController@getCountries')->name('locations.getCountries');
        Route::get('getCountryRegions', 'LocationsController@getCountryRegions')->name('locations.getCountryRegions');
        Route::get('getRegionCities', 'LocationsController@getRegionCities')->name('locations.getRegionCities');
        Route::get('getCityAreas', 'LocationsController@getCityAreas')->name('locations.getCityAreas');
        Route::get('getCountryById', 'LocationsController@getCountryById')->name('locations.getCountryById');
        Route::get('getRegionById', 'LocationsController@getRegionById')->name('locations.getRegionById');
        Route::get('getCityById', 'LocationsController@getCityById')->name('locations.getCityById');
});
