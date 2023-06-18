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
            Route::prefix('welcome_messages')->group(function() {
                Route::group(['middleware' => []], function() {
            
                        Route::group(['middleware' => ['hasPermission:index-welcome-messages']], function() {
                            Route::match(['GET', 'POST'], 'index', 'WelcomeMessagesController@index')->name('welcome_messages.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-welcome-message']], function() {
                            Route::post('store', 'WelcomeMessagesController@store')->name('welcome_messages.store');
                            Route::get('create', 'WelcomeMessagesController@create')->name('welcome_messages.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-welcome-message']], function() {
                            Route::post('update', 'WelcomeMessagesController@update')->name('welcome_messages.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-welcome-message']], function() {
                            Route::post('delete', 'WelcomeMessagesController@delete')->name('welcome_messages.delete');
                            Route::post('deleteWelcomeMessageAttachment', 'WelcomeMessagesController@deleteAttachments')->name('welcome_messages.deleteAttachment');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-welcome-message']], function() {
                                Route::get('createWelcomeMessageModal', 'WelcomeMessagesController@createWelcomeMessageModal')->name('welcome_messages.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-welcome-message']], function() {
                                Route::get('UpdateWelcomeMessageModal/{id?}', 'WelcomeMessagesController@UpdateWelcomeMessageModal')->name('welcome_messages.modals.update');
                            });
                        });
                });
            }); 
        });
    });