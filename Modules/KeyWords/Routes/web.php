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
            Route::prefix('key_words')->group(function () {
                Route::group([], function () {
                    Route::group(['middleware' => ['hasPermission:index-key-words']], function() {
                        Route::match(['GET', 'POST'], 'index', 'KeyWordsController@index')->name('key_words.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-key-word']], function() {
                        Route::post('store', 'KeyWordsController@store')->name('key_words.store');
                        Route::get('create', 'KeyWordsController@create')->name('key_words.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-key-word']], function() {
                        Route::post('update', 'KeyWordsController@update')->name('key_words.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-key-word']], function() {
                        Route::post('delete', 'KeyWordsController@delete')->name('key_words.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-key-word']], function() {
                            Route::get('createKeyWordModal', 'KeyWordsController@createKeyWordModal')->name('key_words.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-key-word']], function() {
                            Route::get('UpdateKeyWordModal/{id?}', 'KeyWordsController@UpdateKeyWordModal')->name('key_words.modals.update');
                        });
                    });
                });
            });
        });
});