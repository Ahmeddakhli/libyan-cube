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
        Route::group(['prefix' =>'admin', 'middleware' => ['web', 'auth','forceSSL','isAdmin']], function () {
            Route::prefix('events')->group(function () {
                Route::group(['middleware' => ['HasEventsModule']], function () {
                    Route::group(['middleware' => ['hasPermission:index-events']], function() {
                        Route::match(['GET', 'POST'], 'index', 'EventsController@index')->name('events.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-event']], function() {
                        Route::post('store', 'EventsController@store')->name('events.store');
                        Route::get('create', 'EventsController@create')->name('events.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-event']], function() {
                        Route::post('update', 'EventsController@update')->name('events.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-event']], function() {
                        Route::post('delete', 'EventsController@delete')->name('events.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-event']], function() {
                            Route::get('createEventModal', 'EventsController@createEventModal')->name('events.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-event']], function() {
                            Route::get('UpdateEventModal/{id?}', 'EventsController@UpdateEventModal')->name('events.modals.update');
                        });
                    });
                });
            });
        });
});