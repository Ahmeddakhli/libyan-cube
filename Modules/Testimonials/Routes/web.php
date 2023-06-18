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
            Route::prefix('testimonials')->group(function() {
                Route::group(['middleware' => []], function() {
                    Route::group(['middleware' => ['hasPermission:index-testimonials']], function() {
                        Route::match(['GET', 'POST'], 'index', 'TestimonialsController@index')->name('testimonials.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-testimonial']], function() {
                        Route::post('store', 'TestimonialsController@store')->name('testimonials.store');
                        Route::get('create', 'TestimonialsController@create')->name('testimonials.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-testimonial']], function() {
                        Route::post('update', 'TestimonialsController@update')->name('testimonials.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-testimonial']], function() {
                        Route::post('delete', 'TestimonialsController@delete')->name('testimonials.delete');
                        Route::post('deleteTestimonialAttachment', 'TestimonialsController@deleteAttachments')->name('testimonials.deleteAttachment');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-testimonial']], function() {
                            Route::get('createTestimonialModal', 'TestimonialsController@createTestimonialModal')->name('testimonials.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-testimonial']], function() {
                            Route::get('UpdateTestimonialModal/{id?}', 'TestimonialsController@UpdateTestimonialModal')->name('testimonials.modals.update');
                        });
                    });
                });
            }); 
        });
    });