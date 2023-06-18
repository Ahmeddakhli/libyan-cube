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
            Route::prefix('seo')->group(function () {
                Route::group([], function () {
                    Route::group(['middleware' => ['hasPermission:index-seo']], function() {
                        Route::match(['GET', 'POST'], 'index', 'SeoController@index')->name('seo.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-seo']], function() {
                        Route::post('store', 'SeoController@store')->name('seo.store');
                        Route::get('create', 'SeoController@create')->name('seo.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-seo']], function() {
                        Route::post('update', 'SeoController@update')->name('seo.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-seo']], function() {
                        Route::post('delete', 'SeoController@delete')->name('seo.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-seo']], function() {
                            Route::get('createSeoModal', 'SeoController@createSeoModal')->name('seo.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-seo']], function() {
                            Route::get('UpdateSeoModal/{id?}', 'SeoController@UpdateSeoModal')->name('seo.modals.update');
                        });
                    });
                    Route::group(['prefix' => 'apply'], function() {
                        Route::get('application', 'SeoController@application')->name('seo.application');
                    });
                });
            });
        });
        Route::group(['prefix' =>'admin', 'middleware' => ['web']], function () {
            Route::prefix('seo')->group(function () {
                Route::group([], function () {
                    Route::group(['prefix' => 'apply'], function() {
                        Route::post('/', 'SeoController@apply')->name('seo.apply');
                    });
                });
            });
        });
    });