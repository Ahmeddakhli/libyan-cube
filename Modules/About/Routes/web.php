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
            Route::prefix('about')->group(function() {
                Route::group(['middleware' => []], function() {
            
                        Route::group(['middleware' => ['hasPermission:index-about-sections']], function() {
                            Route::match(['GET', 'POST'], 'index', 'AboutController@index')->name('about.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-about-section']], function() {
                            Route::post('store', 'AboutController@store')->name('about.store');
                            Route::get('create', 'AboutController@create')->name('about.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-about-section']], function() {
                            Route::post('update', 'AboutController@update')->name('about.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-about-section']], function() {
                            Route::post('delete', 'AboutController@delete')->name('about.delete');
                            Route::post('deleteAboutAttachment', 'AboutController@deleteAttachments')->name('about.deleteAttachment');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-about-section']], function() {
                                Route::get('createAboutModal', 'AboutController@createAboutModal')->name('about.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-about-section']], function() {
                                Route::get('UpdateAboutModal/{id?}', 'AboutController@UpdateAboutModal')->name('about.modals.update');
                            });
                        });
                });
            }); 
        });
    });