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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace' => 'Web'
    ],
    function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
            Route::group(['middleware' => ['isAdmin', 'auth']], function() {
                //
            });
            Route::group(['middleware' => ['web']],function(){
                Route::prefix('compares')->group(function () {
                    Route::get('/', 'ComparesController@index');
                    Route::post('store', 'ComparesController@store')->name('compare.store');
                    Route::post('update', 'ComparesController@update');
                    Route::post('delete', 'ComparesController@delete')->name('compare.delete');
                });
            });
        });
    });