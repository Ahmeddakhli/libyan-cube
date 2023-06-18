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
            Route::prefix('messages')->group(function() {
                Route::group(['middleware' => []], function() {
                    Route::group(['middleware' => ['hasPermission:index-messages']], function() {
                        Route::match(['GET', 'POST'], 'index', 'MessagesController@index')->name('messages.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-message']], function() {
                        Route::post('store', 'MessagesController@store')->name('messages.store');
                        Route::get('create', 'MessagesController@create')->name('messages.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-message']], function() {
                        Route::post('update', 'MessagesController@update')->name('messages.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-message']], function() {
                        Route::post('delete', 'MessagesController@delete')->name('messages.delete');
                        Route::post('read', 'MessagesController@read')->name('messages.read');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-message']], function() {
                            Route::get('createMessageModal', 'MessagesController@createMessageModal')->name('messages.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-message']], function() {
                            Route::get('UpdateMessageModal/{id?}', 'MessagesController@UpdateMessageModal')->name('messages.modals.update');
                        });
                    });
                });
            }); 
        });
    });