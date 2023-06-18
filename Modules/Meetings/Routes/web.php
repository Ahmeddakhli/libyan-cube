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
        Route::group(['prefix' =>'admin', 'middleware' => ['web', 'auth','forceSSL','isAdmin']], function() {
            Route::prefix('meetings')->group(function() {
                Route::group(['middleware' => ['HasMeetingsModule']], function() {
                    Route::group(['middleware' => ['hasPermission:index-meetings']], function() {
                        Route::match(['GET', 'POST'], 'index', 'MeetingsController@index')->name('meetings.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-meeting']], function() {
                        Route::get('create', 'MeetingsController@create')->name('meetings.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-meeting']], function() {
                        Route::post('update', 'MeetingsController@update')->name('meetings.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-meeting']], function() {
                        Route::post('delete', 'MeetingsController@delete')->name('meetings.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-meeting']], function() {
                            Route::get('createMeetingsModal', 'MeetingsController@createMeetingModal')->name('meetings.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-meeting']], function() {
                            Route::get('UpdateMeetingsModal/{id?}', 'MeetingsController@UpdateMeetingsModal')->name('meetings.modals.update');
                        });
                    });
                });
            }); 
        });
        Route::group(['middleware' => ['web', 'auth']], function() {
            Route::prefix('meetings')->group(function() {
                Route::post('store', 'MeetingsController@store')->name('meetings.store');
            });
        });
    });