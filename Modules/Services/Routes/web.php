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
    Route::group(['prefix' =>'admin', 'middleware' => ['web', 'auth','isAdmin']], function () {
        Route::prefix('services')->group(function () {
            Route::group(['middleware' => []], function () {
                Route::group(['middleware' => ['hasPermission:index-services']], function() {
                    Route::match(['GET', 'POST'], 'index', 'ServicesController@index')->name('services.index');
                });
                Route::group(['middleware' => ['hasPermission:create-service']], function() {
                    Route::post('store', 'ServicesController@store')->name('services.store');
                    Route::get('create', 'ServicesController@create')->name('services.create');
                });
                Route::group(['middleware' => ['hasPermission:update-service']], function() {
                    Route::post('update', 'ServicesController@update')->name('services.update');
                });
                Route::group(['middleware' => ['hasPermission:delete-service']], function() {
                    Route::post('delete', 'ServicesController@delete')->name('services.delete');
                });
                Route::group(['perfix' => 'modals'], function() {
                    Route::group(['middleware' => ['hasPermission:create-service']], function() {
                        Route::get('createServiceModal', 'ServicesController@createServiceModal')->name('services.modals.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-service']], function() {
                        Route::get('UpdateServiceModal/{id?}', 'ServicesController@UpdateServiceModal')->name('services.modals.update');
                    });
                });
            });
    });
  
});
});