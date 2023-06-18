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
        Route::prefix('blogs')->group(function () {
            Route::group(['middleware' => []], function () {
                Route::group(['middleware' => ['hasPermission:index-blogs']], function() {
                    Route::match(['GET', 'POST'], 'index', 'BlogsController@index')->name('blogs.index');
                });
                Route::group(['middleware' => ['hasPermission:create-blog']], function() {
                    Route::post('store', 'BlogsController@store')->name('blogs.store');
                    Route::get('create', 'BlogsController@create')->name('blogs.create');
                });
                Route::group(['middleware' => ['hasPermission:update-blog']], function() {
                    Route::post('update', 'BlogsController@update')->name('blogs.update');
                });
                Route::group(['middleware' => ['hasPermission:delete-blog']], function() {
                    Route::post('delete', 'BlogsController@delete')->name('blogs.delete');
                });
                Route::group(['perfix' => 'modals'], function() {
                    Route::group(['middleware' => ['hasPermission:create-blog']], function() {
                        Route::get('createBlogModal', 'BlogsController@createBlogModal')->name('blogs.modals.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-blog']], function() {
                        Route::get('UpdateBlogModal/{id?}', 'BlogsController@UpdateBlogModal')->name('blogs.modals.update');
                    });
                });
            });
    });
    Route::prefix('blog_categories')->group(function () {
        Route::group(['middleware' => []], function () {
            Route::group(['middleware' => ['hasPermission:index-blog-categories']], function() {
                Route::match(['GET', 'POST'], 'index', 'CategoriesController@index')->name('blog.categories.index');
            });
            Route::group(['middleware' => ['hasPermission:create-blog-category']], function() {
                Route::post('store', 'CategoriesController@store')->name('blog.categories.store');
                Route::get('create', 'CategoriesController@create')->name('blog.categories.create');
            });
            Route::group(['middleware' => ['hasPermission:update-blog-category']], function() {
                Route::post('update', 'CategoriesController@update')->name('blog.categories.update');
            });
            Route::group(['middleware' => ['hasPermission:delete-blog-category']], function() {
                Route::post('delete', 'CategoriesController@delete')->name('blog.categories.delete');
            });
            Route::group(['perfix' => 'modals'], function() {
                Route::group(['middleware' => ['hasPermission:create-blog-category']], function() {
                    Route::get('createBlogModal', 'CategoriesController@createBlogModal')->name('blog.categories.modals.create');
                });
                Route::group(['middleware' => ['hasPermission:update-blog-category']], function() {
                    Route::get('UpdateBlogModal/{id?}', 'CategoriesController@UpdateBlogModal')->name('blog.categories.modals.update');
                });
            });
        });
    });
});
});