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
        Route::group(['prefix' =>'admin', 'middleware' => ['web', 'auth', 'isAdmin']], function() {
            Route::prefix('terms')->group(function() {
                Route::group(['middleware' => []], function() {
            
                        Route::group(['middleware' => ['hasPermission:index-terms-conditions']], function() {
                            Route::match(['GET', 'POST'], 'index', 'CmsController@index')->name('terms.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-terms-condition']], function() {
                            Route::post('store', 'CmsController@store')->name('terms.store');
                            Route::get('create', 'CmsController@create')->name('terms.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-terms-condition']], function() {
                            Route::post('update', 'CmsController@update')->name('terms.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-terms-condition']], function() {
                            Route::post('delete', 'CmsController@delete')->name('terms.delete');
                            Route::post('deleteAboutAttachment', 'CmsController@deleteAttachments')->name('terms.deleteAttachment');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-terms-condition']], function() {
                                Route::get('createTermModal', 'CmsController@createTermModal')->name('terms.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-terms-condition']], function() {
                                Route::get('UpdateTermModal/{id?}', 'CmsController@UpdateTermModal')->name('terms.modals.update');
                            });
                        });
                });
            }); 
            Route::prefix('privacies')->group(function() {
                Route::group(['middleware' => []], function() {
            
                        Route::group(['middleware' => ['hasPermission:index-privacies']], function() {
                            Route::match(['GET', 'POST'], 'index', 'PrivaciesController@index')->name('privacies.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-privacy']], function() {
                            Route::post('store', 'PrivaciesController@store')->name('privacies.store');
                            Route::get('create', 'PrivaciesController@create')->name('privacies.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-privacy']], function() {
                            Route::post('update', 'PrivaciesController@update')->name('privacies.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-privacy']], function() {
                            Route::post('delete', 'PrivaciesController@delete')->name('privacies.delete');
                            Route::post('deleteAboutAttachment', 'PrivaciesController@deleteAttachments')->name('privacies.deleteAttachment');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-privacy']], function() {
                                Route::get('createPrivacyModal', 'PrivaciesController@createPrivacyModal')->name('privacies.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-privacy']], function() {
                                Route::get('UpdatePrivacyModal/{id?}', 'PrivaciesController@UpdatePrivacyModal')->name('privacies.modals.update');
                            });
                        });
                });
            }); 
        });
    });