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
            Route::prefix('careers')->group(function () {
                Route::group([], function () {
                    Route::group(['middleware' => ['hasPermission:index-careers']], function() {
                        Route::match(['GET', 'POST'], 'index', 'CareersController@index')->name('careers.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-career']], function() {
                        Route::post('store', 'CareersController@store')->name('careers.store');
                        Route::get('create', 'CareersController@create')->name('careers.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-career']], function() {
                        Route::post('update', 'CareersController@update')->name('careers.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-career']], function() {
                        Route::post('delete', 'CareersController@delete')->name('careers.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-career']], function() {
                            Route::get('createCareerModal', 'CareersController@createCareerModal')->name('careers.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-career']], function() {
                            Route::get('UpdateCareerModal/{id?}', 'CareersController@UpdateCareerModal')->name('careers.modals.update');
                        });
                    });
                    Route::group(['prefix' => 'apply'], function() {
                        Route::get('application', 'CareersController@application')->name('careers.application');
                    });
                });
            });
        });
        Route::group(['prefix' =>'admin', 'middleware' => ['web']], function () {
            Route::prefix('careers')->group(function () {
                Route::group([], function () {
                    Route::group(['prefix' => 'apply'], function() {
                        Route::post('/', 'CareersController@apply')->name('careers.apply');
                    });
                });
            });
        });
    });