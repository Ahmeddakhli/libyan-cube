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
    Route::prefix('notifications')->group(function() {
        Route::group([], function() {
            Route::group(['middleware' => ['web', 'auth']], function() {
                Route::group(['prefix' => 'notifications'], function() {                
                    Route::get('/', 'NotificationsController@index');
                    Route::patch('{id}/read', 'NotificationsController@markAsRead');
                    Route::post('mark-all-read', 'NotificationsController@markAllRead');
                });
                Route::group(['prefix' => 'subscriptions'], function() {
                    Route::post('/', 'PushSubscriptionsController@update');
                    Route::post('delete', 'PushSubscriptionsController@destroy');
                });
            });
            Route::group(['middleware' => ['web']], function() {
                Route::group(['prefix' => 'notifications'], function() {
                    Route::post('{id}/dismiss', 'NotificationsController@dismiss');
                });
            });
        });
    });
});