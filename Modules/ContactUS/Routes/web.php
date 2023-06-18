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
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'isAdmin']], function () {
            Route::prefix('contact_us')->group(function () {
                Route::group(['middleware' => []], function () {
                    Route::group(['middleware' => ['hasPermission:index-contact-us']], function () {
                        Route::match(['GET', 'POST'], 'index', 'ContactUSController@index')->name('contact_us.contact_us.index');
                        Route::match(['GET', 'POST'], 'indexRequests', 'ContactUSController@indexRequests')->name('contact_us.contact_us.indexRequests');
                    });
                    Route::group(['middleware' => ['hasPermission:create-contact-us']], function () {
                        Route::get('create', 'ContactUSController@create')->name('contact_us.contact_us.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-contact-us']], function () {
                        Route::post('update', 'ContactUSController@update')->name('contact_us.contact_us.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-contact-us']], function () {
                        Route::post('delete', 'ContactUSController@delete')->name('contact_us.contact_us.delete');
                        Route::post('read', 'ContactUSController@read')->name('contact_us.contact_us.read');
                    });
                    Route::group(['perfix' => 'modals'], function () {
                        Route::group(['middleware' => ['hasPermission:create-contact-us']], function () {
                            Route::get('createContactUsModal', 'ContactUSController@createContactUsModal')->name('contact_us.contact_us.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-contact-us']], function () {
                            Route::get('UpdateContactUsModal/{id?}', 'ContactUSController@UpdateContactUsModal')->name('contact_us.contact_us.modals.update');
                        });
                    });
                });
            });
            Route::prefix('subscribes')->group(function () {
                Route::group(['middleware' => []], function () {
                    Route::group(['middleware' => ['hasPermission:index-subscribe-mails']], function () {
                        Route::match(['GET', 'POST'], 'index', 'SubscribesController@index')->name('contact_us.subscribes.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-subscribe-mail']], function () {
                        Route::get('create', 'SubscribesController@create')->name('contact_us.subscribes.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-subscribe-mail']], function () {
                        Route::post('update', 'SubscribesController@update')->name('contact_us.subscribes.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-subscribe-mail']], function () {
                        Route::post('delete', 'SubscribesController@delete')->name('contact_us.subscribes.delete');
                    });
                    Route::group(['perfix' => 'modals'], function () {
                        Route::group(['middleware' => ['hasPermission:create-subscribe-mail']], function () {
                            Route::get('createSubscribeModal', 'SubscribesController@createSubscribeModal')->name('contact_us.subscribes.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-subscribe-mail']], function () {
                            Route::get('UpdateSubscribeModal/{id?}', 'SubscribesController@UpdateSubscribeModal')->name('contact_us.subscribes.modals.update');
                        });
                    });
                });
            });
        });
        Route::group(['middleware' => ['web']], function () {
            Route::prefix('contact_us')->group(function () {
                Route::post('store', 'ContactUSController@store')->name('contact_us.contact_us.store');
            });
        });
        Route::group(['middleware' => ['web']], function () {
            Route::prefix('subscribes')->group(function () {
                Route::post('store', 'SubscribesController@store')->name('contact_us.subscribes.store');
            });
        });
});
