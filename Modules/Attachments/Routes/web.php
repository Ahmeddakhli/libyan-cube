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

use Modules\Attachments\Entities\Attachmentable;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace' => 'Web'
    ],
    function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
            Route::prefix('attachments')->group(function () {
                Route::get('fix', function () {
                    $attachments = Attachmentable::all();
                    foreach ($attachments as $attachment) {
                        $attachment->update([
                            'alt' => $attachment->file_name
                        ]);
                    }
                });
                Route::group([], function () {
                    Route::get('index', 'AttachmentsController@index')->name('attachments.index');
                    Route::post('delete', 'AttachmentsController@delete')->name('delete.attachmentables');
                    Route::post('deleteMedia', 'AttachmentsController@deleteMedia')->name('delete.media');
                });
            });
        });
    }
);
