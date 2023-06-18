<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function () {
        Route::group(['middleware' => ['auth:api', 'HasBlogModule']], function () {
            Route::group(['prefix' => 'blog'], function () {
                Route::get('/', 'BlogsController@index');
                Route::post('store', 'BlogsController@store');
                Route::post('update', 'BlogsController@update');
                Route::post('delete', 'BlogsController@delete');
            });
            Route::group(['prefix' => 'blog_categories'], function () {
                Route::get('/', 'CategoriesController@index');
                Route::post('store', 'CategoriesController@store');
                Route::post('update', 'CategoriesController@update');
                Route::post('delete', 'CategoriesController@delete');
            });
        });
    });
});
