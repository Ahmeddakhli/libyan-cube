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
            Route::prefix('socials')->group(function() {
                Route::group(['middleware' => []], function() {
                    Route::group(['middleware' => ['hasPermission:index-socials']], function() {
                        Route::match(['GET', 'POST'], 'index', 'SocialsController@index')->name('socials.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-social']], function() {
                        Route::post('store', 'SocialsController@store')->name('socials.store');
                        Route::get('create', 'SocialsController@create')->name('socials.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-social']], function() {
                        Route::post('update', 'SocialsController@update')->name('socials.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-social']], function() {
                        Route::post('delete', 'SocialsController@delete')->name('socials.delete');
                        Route::post('deleteSocialAttachment', 'SocialsController@deleteAttachments')->name('socials.deleteAttachment');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-social']], function() {
                            Route::get('createSocialModal', 'SocialsController@createSocialModal')->name('socials.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-social']], function() {
                            Route::get('UpdateSocialModal/{id?}', 'SocialsController@UpdateSocialModal')->name('socials.modals.update');
                        });
                    });
                });
            }); 
        });
    });