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
        Route::prefix('tags')->group(function() {
            Route::group(['middleware' => []], function() {
                Route::group(['middleware' => ['hasPermission:index-tags']], function() {
                    Route::match(['GET', 'POST'], 'index', 'TagsController@index')->name('tags.index');
                });
                Route::group(['middleware' => ['hasPermission:create-tag']], function() {
                    Route::post('store', 'TagsController@store')->name('tags.store');
                    Route::get('create', 'TagsController@create')->name('tags.create');
                });
                Route::group(['middleware' => ['hasPermission:update-tag']], function() {
                    Route::post('update', 'TagsController@update')->name('tags.update');
                });
                Route::group(['middleware' => ['hasPermission:delete-tag']], function() {
                    Route::post('delete', 'TagsController@delete')->name('tags.delete');
                });
                Route::group(['perfix' => 'modals'], function() {
                    Route::group(['middleware' => ['hasPermission:create-tag']], function() {
                        Route::get('createTagModal', 'TagsController@createTagModal')->name('tags.modals.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-tag']], function() {
                        Route::get('updateTagModal/{id?}', 'TagsController@updateTagModal')->name('tags.modals.update');
                    });
                });
            });
        });
    });
});