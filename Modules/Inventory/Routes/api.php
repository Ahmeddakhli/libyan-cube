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

Route::group(['namespace' => 'Api'], function() {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function() {
        Route::group(['middleware' => ['auth:api', 'HasInventoryModule']], function() {
            Route::group(['prefix' => 'inventory'], function() {
                Route::group(['prefix' => 'developers'], function() {
                    Route::get('/', 'IDevelopersController@GetIDevelopers');
                    Route::post('store', 'IDevelopersController@store');
                    Route::post('update', 'IDevelopersController@update');
                    Route::post('delete', 'IDevelopersController@delete');
                });
                Route::group(['prefix' => 'area_units'], function() {
                    Route::get('/', 'IAreaUnitsController@GetIAreaUnits');
                    Route::post('store', 'IAreaUnitsController@store');
                    Route::post('update', 'IAreaUnitsController@update');
                    Route::post('delete', 'IAreaUnitsController@delete');
                });
                Route::group(['prefix' => 'bathrooms'], function() {
                    Route::get('/', 'IBathroomsController@GetIBathrooms');
                    Route::post('store', 'IBathroomsController@store');
                    Route::post('update', 'IBathroomsController@update');
                    Route::post('delete', 'IBathroomsController@delete');
                });
                Route::group(['prefix' => 'bedrooms'], function() {
                    Route::get('/', 'IBedroomsController@GetIBedrooms');
                    Route::post('store', 'IBedroomsController@store');
                    Route::post('update', 'IBedroomsController@update');
                    Route::post('delete', 'IBedroomsController@delete');
                });
                Route::group(['prefix' => 'finishing_types'], function() {
                    Route::get('/', 'IFinishingTypesController@GetIFinishingTypes');
                    Route::post('store', 'IFinishingTypesController@store');
                    Route::post('update', 'IFinishingTypesController@update');
                    Route::post('delete', 'IFinishingTypesController@delete');
                });
                Route::group(['prefix' => 'furnishing_statuses'], function() {
                    Route::get('/', 'IFurnishingStatusesController@GetIFurnishingStatuses');
                    Route::post('store', 'IFurnishingStatusesController@store');
                    Route::post('update', 'IFurnishingStatusesController@update');
                    Route::post('delete', 'IFurnishingStatusesController@delete');
                });
                Route::group(['prefix' => 'offering_types'], function() {
                    Route::get('/', 'IOfferingTypesController@GetIOfferingTypes');
                    Route::post('store', 'IOfferingTypesController@store');
                    Route::post('update', 'IOfferingTypesController@update');
                    Route::post('delete', 'IOfferingTypesController@delete');
                });
                Route::group(['prefix' => 'payment_methods'], function() {
                    Route::get('/', 'IPaymentMethodsController@GetIPaymentMethods');
                    Route::post('store', 'IPaymentMethodsController@store');
                    Route::post('update', 'IPaymentMethodsController@update');
                    Route::post('delete', 'IPaymentMethodsController@delete');
                });
                Route::group(['prefix' => 'phases'], function() {
                    Route::get('/', 'IPhasesController@GetIPhases');
                    Route::post('store', 'IPhasesController@store');
                    Route::post('update', 'IPhasesController@update');
                    Route::post('delete', 'IPhasesController@delete');
                });
                Route::group(['prefix' => 'positions'], function() {
                    Route::get('/', 'IPositionsController@GetIPositions');
                    Route::post('store', 'IPositionsController@store');
                    Route::post('update', 'IPositionsController@update');
                    Route::post('delete', 'IPositionsController@delete');
                });
                Route::group(['prefix' => 'views'], function() {
                    Route::get('/', 'IViewsController@GetIViews');
                    Route::post('store', 'IViewsController@store');
                    Route::post('update', 'IViewsController@update');
                    Route::post('delete', 'IViewsController@delete');
                });
                Route::group(['prefix' => 'facilities'], function() {
                    Route::get('/', 'IFacilitiesController@GetIfacilities');
                    Route::post('store', 'IFacilitiesController@store');
                    Route::post('update', 'IFacilitiesController@update');
                    Route::post('delete', 'IFacilitiesController@delete');
                });
                Route::group(['prefix' => 'amenities'], function() {
                    Route::get('/', 'IAmenitiesController@GetIAmenities');
                    Route::post('store', 'IAmenitiesController@store');
                    Route::post('update', 'IAmenitiesController@update');
                    Route::post('delete', 'IAmenitiesController@delete');
                });
                Route::group(['prefix' => 'purposes'], function() {
                    Route::get('/', 'IPurposesController@GetIPurposes');
                    Route::post('store', 'IPurposesController@store');
                    Route::post('update', 'IPurposesController@update');
                    Route::post('delete', 'IPurposesController@delete');
                });
                Route::group(['prefix' => 'purpose_types'], function() {
                    Route::get('/', 'IPurposeTypesController@GetIPurposeTypes');
                    Route::get('GetIPurposePurposeTypes', 'IPurposeTypesController@GetIPurposePurposeTypes');
                    Route::post('store', 'IPurposeTypesController@store');
                    Route::post('update', 'IPurposeTypesController@update');
                    Route::post('delete', 'IPurposeTypesController@delete');
                });
                Route::group(['prefix' => 'projects'], function() {
                    Route::get('/', 'IProjectsController@GetIProjects');
                    Route::post('store', 'IProjectsController@store');
                    Route::post('update', 'IProjectsController@update');
                    Route::post('delete', 'IProjectsController@delete');
                });
                Route::group(['prefix' => 'units'], function() {
                    Route::get('/', 'IUnitsController@GetIUnits');
                    Route::get('/{id}', 'IUnitsController@show');
                    Route::post('store', 'IUnitsController@store');
                    Route::post('myUnits', 'IUnitsController@myUnits');
                    Route::post('update', 'IUnitsController@update');
                    Route::post('delete', 'IUnitsController@delete');
                    Route::post('deleteAttachment', 'IUnitsController@deleteAttachment');
                });

                Route::group(['prefix' => 'rental_cases'], function() {
                    Route::get('/', 'IRentalCasesController@GetIRentalCases');
                    Route::post('store', 'IRentalCasesController@store');
                    Route::post('update', 'IRentalCasesController@update');
                    Route::post('delete', 'IRentalCasesController@delete');
                });

                Route::group(['prefix' => 'publish_times'], function() {
                    Route::get('/', 'IPublishTimesController@GetIPublishTimes');
                    Route::post('store', 'IPublishTimesController@store');
                    Route::post('update', 'IPublishTimesController@update');
                    Route::post('delete', 'IPublishTimesController@delete');
                });
                Route::group(['prefix' => 'floor_numbers'], function() {
                    Route::get('/', 'IFloorNumbersController@GetIFloorNumbers');
                    Route::post('store', 'IFloorNumbersController@store');
                    Route::post('update', 'IFloorNumbersController@update');
                    Route::post('delete', 'IFloorNumbersController@delete');
                });
                Route::group(['prefix' => 'favorites'], function () {
                    Route::post('store', 'IFavoritesController@store');
                    Route::post('delete', 'IFavoritesController@destroy');
                });
                Route::group(['prefix' => 'design_types'], function() {
                    Route::get('/', 'IDesignTypesController@GetIDesignTypes');
                    Route::post('store', 'IDesignTypesController@store');
                    Route::post('update', 'IDesignTypesController@update');
                    Route::post('delete', 'IDesignTypesController@delete');
                });
                Route::group(['prefix' => 'sell_requests'], function() {
                    Route::get('/', 'ISellRequestsController@index');
                    Route::post('store', 'ISellRequestsController@store');
                    Route::post('update', 'ISellRequestsController@update');
                    Route::post('delete', 'ISellRequestsController@delete');
                });
            });
        });
    });
});