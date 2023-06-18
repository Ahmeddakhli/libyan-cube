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

use Modules\Inventory\IProject;
use Illuminate\Support\Str;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
    'namespace' => 'Web'
],
function()
{
    Route::group(['prefix' =>'admin', 'middleware' => ['web', 'auth','isAdmin']], function() {
        Route::prefix('inventory')->group(function() {
            Route::group(['middleware' => []], function() {
                Route::get('settings', 'InventoryController@settings')->name('inventory.settings');

                Route::group(['prefix' => 'developers'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-developers']], function() {
                        Route::get('GetIDevelopers', 'IDevelopersController@GetIDevelopers')->name('inventory.developers.GetIDevelopers');
                        Route::match(['GET', 'POST'], 'index', 'IDevelopersController@index')->name('inventory.developers.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-developer']], function() {
                        Route::post('store', 'IDevelopersController@store')->name('inventory.developers.store');
                        Route::get('create', 'IDevelopersController@create')->name('inventory.developers.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-developer']], function() {
                        Route::post('update', 'IDevelopersController@update')->name('inventory.developers.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-developer']], function() {
                        Route::post('delete', 'IDevelopersController@delete')->name('inventory.developers.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-developer']], function() {
                            Route::get('createIDeveloperModal', 'IDevelopersController@createIDeveloperModal')->name('inventory.developers.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-developer']], function() {
                            Route::get('UpdateIDeveloperModal/{id?}', 'IDevelopersController@UpdateIDeveloperModal')->name('inventory.developers.modals.update');
                        });
                    });

                    Route::get('tagsinput', 'IDevelopersController@tagsinput')->name('inventory.developers.tagsinput');
                });

                Route::group(['prefix' => 'area-units'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-area-units']], function() {

                        Route::match(['GET', 'POST'], 'index', 'IAreaUnitsController@index')->name('inventory.area_units.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-area-unit']], function() {
                        Route::post('store', 'IAreaUnitsController@store')->name('inventory.area_units.store');
                        Route::get('create', 'IAreaUnitsController@create')->name('inventory.area_units.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-area-unit']], function() {
                        Route::post('update', 'IAreaUnitsController@update')->name('inventory.area_units.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-area-unit']], function() {
                        Route::post('delete', 'IAreaUnitsController@delete')->name('inventory.area_units.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-area-unit']], function() {
                            Route::get('createIAreaUnitModal', 'IAreaUnitsController@createIAreaUnitModal')->name('inventory.area_units.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-area-unit']], function() {
                            Route::get('UpdateIAreaUnitModal/{id?}', 'IAreaUnitsController@UpdateIAreaUnitModal')->name('inventory.area_units.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'bathrooms'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-bathrooms']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IBathroomsController@index')->name('inventory.bathrooms.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-bathroom']], function() {
                        Route::post('store', 'IBathroomsController@store')->name('inventory.bathrooms.store');
                        Route::get('create', 'IBathroomsController@create')->name('inventory.bathrooms.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-bathroom']], function() {
                        Route::post('update', 'IBathroomsController@update')->name('inventory.bathrooms.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-bathroom']], function() {
                        Route::post('delete', 'IBathroomsController@delete')->name('inventory.bathrooms.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-bathroom']], function() {
                            Route::get('createIBathroomModal', 'IBathroomsController@createIBathroomModal')->name('inventory.bathrooms.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-bathroom']], function() {
                            Route::get('UpdateIBathroomModal/{id?}', 'IBathroomsController@UpdateIBathroomModal')->name('inventory.bathrooms.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'bedrooms'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-bedrooms']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IBedroomsController@index')->name('inventory.bedrooms.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-bedroom']], function() {
                        Route::post('store', 'IBedroomsController@store')->name('inventory.bedrooms.store');
                        Route::get('create', 'IBedroomsController@create')->name('inventory.bedrooms.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-bedroom']], function() {
                        Route::post('update', 'IBedroomsController@update')->name('inventory.bedrooms.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-bedroom']], function() {
                        Route::post('delete', 'IBedroomsController@delete')->name('inventory.bedrooms.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-bedroom']], function() {
                            Route::get('createIBedroomModal', 'IBedroomsController@createIBedroomModal')->name('inventory.bedrooms.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-bedroom']], function() {
                            Route::get('UpdateIBedroomModal/{id?}', 'IBedroomsController@UpdateIBedroomModal')->name('inventory.bedrooms.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'finishing-types'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-finishing-types']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IFinishingTypesController@index')->name('inventory.finishing_types.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-finishing-type']], function() {
                        Route::post('store', 'IFinishingTypesController@store')->name('inventory.finishing_types.store');
                        Route::get('create', 'IFinishingTypesController@create')->name('inventory.finishing_types.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-finishing-type']], function() {
                        Route::post('update', 'IFinishingTypesController@update')->name('inventory.finishing_types.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-finishing-type']], function() {
                        Route::post('delete', 'IFinishingTypesController@delete')->name('inventory.finishing_types.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-finishing-type']], function() {
                            Route::get('createIFinishingTypeModal', 'IFinishingTypesController@createIFinishingTypeModal')->name('inventory.finishing_types.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-finishing-type']], function() {
                            Route::get('UpdateIFinishingTypeModal/{id?}', 'IFinishingTypesController@UpdateIFinishingTypeModal')->name('inventory.finishing_types.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'furnishing-statuses'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-furnishing-statuses']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IFurnishingStatusesController@index')->name('inventory.furnishing_statuses.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-furnishing-status']], function() {
                        Route::post('store', 'IFurnishingStatusesController@store')->name('inventory.furnishing_statuses.store');
                        Route::get('create', 'IFurnishingStatusesController@create')->name('inventory.furnishing_statuses.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-furnishing-status']], function() {
                        Route::post('update', 'IFurnishingStatusesController@update')->name('inventory.furnishing_statuses.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-furnishing-status']], function() {
                        Route::post('delete', 'IFurnishingStatusesController@delete')->name('inventory.furnishing_statuses.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-furnishing-status']], function() {
                            Route::get('createIFurnishingStatusModal', 'IFurnishingStatusesController@createIFurnishingStatusModal')->name('inventory.furnishing_statuses.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-furnishing-status']], function() {
                            Route::get('UpdateIFurnishingStatusModal/{id?}', 'IFurnishingStatusesController@UpdateIFurnishingStatusModal')->name('inventory.furnishing_statuses.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'offering-types'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-offering-types']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IOfferingTypesController@index')->name('inventory.offering_types.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-offering-type']], function() {
                        Route::post('store', 'IOfferingTypesController@store')->name('inventory.offering_types.store');
                        Route::get('create', 'IOfferingTypesController@create')->name('inventory.offering_types.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-offering-type']], function() {
                        Route::post('update', 'IOfferingTypesController@update')->name('inventory.offering_types.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-offering-type']], function() {
                        Route::post('delete', 'IOfferingTypesController@delete')->name('inventory.offering_types.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-offering-type']], function() {
                            Route::get('createIOfferingTypeModal', 'IOfferingTypesController@createIOfferingTypeModal')->name('inventory.offering_types.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-offering-type']], function() {
                            Route::get('UpdateIOfferingTypeModal/{id?}', 'IOfferingTypesController@UpdateIOfferingTypeModal')->name('inventory.offering_types.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'payment-methods'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-payment-methods']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IPaymentMethodsController@index')->name('inventory.payment_methods.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-payment-method']], function() {
                        Route::post('store', 'IPaymentMethodsController@store')->name('inventory.payment_methods.store');
                        Route::get('create', 'IPaymentMethodsController@create')->name('inventory.payment_methods.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-payment-method']], function() {
                        Route::post('update', 'IPaymentMethodsController@update')->name('inventory.payment_methods.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-payment-method']], function() {
                        Route::post('delete', 'IPaymentMethodsController@delete')->name('inventory.payment_methods.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-payment-method']], function() {
                            Route::get('createIPaymentMethodModal', 'IPaymentMethodsController@createIPaymentMethodModal')->name('inventory.payment_methods.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-payment-method']], function() {
                            Route::get('UpdateIPaymentMethodModal/{id?}', 'IPaymentMethodsController@UpdateIPaymentMethodModal')->name('inventory.payment_methods.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'positions'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-positions']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IPositionsController@index')->name('inventory.positions.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-position']], function() {
                        Route::post('store', 'IPositionsController@store')->name('inventory.positions.store');
                        Route::get('create', 'IPositionsController@create')->name('inventory.positions.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-position']], function() {
                        Route::post('update', 'IPositionsController@update')->name('inventory.positions.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-position']], function() {
                        Route::post('delete', 'IPositionsController@delete')->name('inventory.positions.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-position']], function() {
                            Route::get('createIPositionModal', 'IPositionsController@createIPositionModal')->name('inventory.positions.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-position']], function() {
                            Route::get('UpdateIPositionModal/{id?}', 'IPositionsController@UpdateIPositionModal')->name('inventory.positions.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'views'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-views']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IViewsController@index')->name('inventory.views.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-view']], function() {
                        Route::post('store', 'IViewsController@store')->name('inventory.views.store');
                        Route::get('create', 'IViewsController@create')->name('inventory.views.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-view']], function() {
                        Route::post('update', 'IViewsController@update')->name('inventory.views.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-view']], function() {
                        Route::post('delete', 'IViewsController@delete')->name('inventory.views.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-view']], function() {
                            Route::get('createIViewModal', 'IViewsController@createIViewModal')->name('inventory.views.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-view']], function() {
                            Route::get('UpdateIViewModal/{id?}', 'IViewsController@UpdateIViewModal')->name('inventory.views.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'facilities'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-facilities']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IFacilitiesController@index')->name('inventory.facilities.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-facility']], function() {
                        Route::post('store', 'IFacilitiesController@store')->name('inventory.facilities.store');
                        Route::get('create', 'IFacilitiesController@create')->name('inventory.facilities.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-facility']], function() {
                        Route::post('update', 'IFacilitiesController@update')->name('inventory.facilities.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-facility']], function() {
                        Route::post('delete', 'IFacilitiesController@delete')->name('inventory.facilities.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-facility']], function() {
                            Route::get('createIFacilityModal', 'IFacilitiesController@createIFacilityModal')->name('inventory.facilities.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-facility']], function() {
                            Route::get('UpdateIFacilityModal/{id?}', 'IFacilitiesController@UpdateIFacilityModal')->name('inventory.facilities.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'amenities'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-amenities']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IAmenitiesController@index')->name('inventory.amenities.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-amenity']], function() {
                        Route::post('store', 'IAmenitiesController@store')->name('inventory.amenities.store');
                        Route::get('create', 'IAmenitiesController@create')->name('inventory.amenities.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-amenity']], function() {
                        Route::post('update', 'IAmenitiesController@update')->name('inventory.amenities.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-amenity']], function() {
                        Route::post('delete', 'IAmenitiesController@delete')->name('inventory.amenities.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-amenity']], function() {
                            Route::get('createIAmenityModal', 'IAmenitiesController@createIAmenityModal')->name('inventory.amenities.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-amenity']], function() {
                            Route::get('UpdateIAmenityModal/{id?}', 'IAmenitiesController@UpdateIAmenityModal')->name('inventory.amenities.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'purposes'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-purposes']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IPurposesController@index')->name('inventory.purposes.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-purpose']], function() {
                        Route::post('store', 'IPurposesController@store')->name('inventory.purposes.store');
                        Route::get('create', 'IPurposesController@create')->name('inventory.purposes.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-purpose']], function() {
                        Route::post('update', 'IPurposesController@update')->name('inventory.purposes.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-purpose']], function() {
                        Route::post('delete', 'IPurposesController@delete')->name('inventory.purposes.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-purpose']], function() {
                            Route::get('createIPurposeModal', 'IPurposesController@createIPurposeModal')->name('inventory.purposes.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-purpose']], function() {
                            Route::get('UpdateIPurposeModal/{id?}', 'IPurposesController@UpdateIPurposeModal')->name('inventory.purposes.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'purpose-types'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-purpose-types']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IPurposeTypesController@index')->name('inventory.purpose_types.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-purpose-type']], function() {
                        Route::post('store', 'IPurposeTypesController@store')->name('inventory.purpose_types.store');
                        Route::get('create', 'IPurposeTypesController@create')->name('inventory.purpose_types.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-purpose-type']], function() {
                        Route::post('update', 'IPurposeTypesController@update')->name('inventory.purpose_types.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-purpose-type']], function() {
                        Route::post('delete', 'IPurposeTypesController@delete')->name('inventory.purpose_types.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-purpose-type']], function() {
                            Route::get('createIPurposeTypeModal', 'IPurposeTypesController@createIPurposeTypeModal')->name('inventory.purpose_types.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-purpose-type']], function() {
                            Route::get('UpdateIPurposeTypeModal/{id?}', 'IPurposeTypesController@UpdateIPurposeTypeModal')->name('inventory.purpose_types.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'projects'], function() {
                    Route::get('products/publish',function(){
                        $projects = IProject::whereNull('deleted_at')->get();
                        foreach($projects as $project){
                            $project->update([
                                'publish_id' => Str::uuid()
                            ]);
                        }
                    });
                    Route::group(['middleware' => ['hasPermission:index-inventory-projects']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IProjectsController@index')->name('inventory.projects.index');
                        Route::get('show/{id}','IProjectsController@show')->name('inventory.projects.show');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-project']], function() {
                        Route::post('store', 'IProjectsController@store')->name('inventory.projects.store');
                        Route::get('create', 'IProjectsController@create')->name('inventory.projects.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-project']], function() {
                        Route::post('update', 'IProjectsController@update')->name('inventory.projects.update');
                        Route::post('publish', 'IProjectsController@publish')->name('inventory.projects.publish');
                    });
                    Route::group(['middleware' => ['hasPermission:export-inventory-projects']], function() {
                        Route::post('export', 'IProjectsController@export')->name('inventory.projects.export');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-project']], function() {
                        Route::post('delete', 'IProjectsController@delete')->name('inventory.projects.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-project']], function() {
                            Route::get('createIProjectModal', 'IProjectsController@createIProjectModal')->name('inventory.projects.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-project']], function() {
                            Route::get('edit/{id}', 'IProjectsController@UpdateIProjectModal')->name('inventory.projects.modals.update');
                        });
                    });
                    Route::group(['perfix' => 'partials'], function() {
                        Route::post('get-phases-repeater-partial', 'IProjectsController@getPhasesRepeaterPartial')->name('inventory.projects.partials.get_phases_repeater_partial');
                    });
                    Route::get('tagsinput', 'IProjectsController@tagsinput')->name('inventory.projects.tagsinput');
                });

                Route::group(['prefix' => 'units'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-units']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IUnitsController@index')->name('inventory.units.index');
                    });
                    Route::group(['middleware' => ['hasPermission:export-inventory-unit']], function() {
                        Route::post('export', 'IUnitsController@export')->name('inventory.units.export');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-unit']], function() {
                        Route::post('store', 'IUnitsController@store')->name('inventory.units.store');
                        Route::get('create', 'IUnitsController@create')->name('inventory.units.create');
                        Route::post('import', 'IUnitsController@import')->name('inventory.units.import');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-unit']], function() {
                        Route::post('update', 'IUnitsController@update')->name('inventory.units.update');
                    });
                    Route::post('upload', 'IUnitsController@upload')->name('inventory.units.upload');
                    Route::group(['middleware' => ['hasPermission:delete-inventory-unit']], function() {
                        Route::post('delete', 'IUnitsController@delete')->name('inventory.units.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        // Route::group(['middleware' => ['hasPermission:create-inventory-unit']], function() {
                        //     Route::get('createIUnitModal', 'IUnitsController@createIUnitModal')->name('inventory.units.modals.create');
                        // });
                        Route::group(['middleware' => ['hasPermission:update-inventory-unit']], function() {
                            Route::get('UpdateIUnitModal/{id?}', 'IUnitsController@UpdateIUnitModal')->name('inventory.units.modals.update');
                            Route::get('importModal', 'IUnitsController@importModal')->name('inventory.units.importModal');
                        });
                    });
                    Route::group(['middleware' => ['hasPermission:view-inventory-unit']], function() {
                        Route::get('unit/{id}', 'IUnitsController@show')->name('inventory.units.unit');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-unit-attachment']], function() {
                        Route::post('unit/attachment/delete', 'IUnitsController@deleteAttachment')->name('inventory.units.unit.attachment.delete');
                    });
                    Route::get('tagsinput', 'IUnitsController@tagsinput')->name('inventory.units.tagsinput');
                });

                Route::group(['prefix' => 'rental-cases'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-rental-cases']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IRentalCasesController@index')->name('inventory.rental_cases.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-rental-case']], function() {
                        Route::post('store', 'IRentalCasesController@store')->name('inventory.rental_cases.store');
                        // Route::get('create', 'IRentalCasesController@create')->name('inventory.rental_cases.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-rental-case']], function() {
                        Route::post('update', 'IRentalCasesController@update')->name('inventory.rental_cases.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-rental-case']], function() {
                        Route::post('delete', 'IRentalCasesController@delete')->name('inventory.rental_cases.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-rental-case']], function() {
                            Route::get('createIRentalCaseModal', 'IRentalCasesController@createIRentalCaseModal')->name('inventory.rental_cases.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-rental-case']], function() {
                            Route::get('UpdateIRentalCaseModal/{id?}', 'IRentalCasesController@UpdateIRentalCaseModal')->name('inventory.rental_cases.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'publish-times'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-publish-times']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IPublishTimesController@index')->name('inventory.publish_times.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-publish-time']], function() {
                        Route::post('store', 'IPublishTimesController@store')->name('inventory.publish_times.store');
                        // Route::get('create', 'IPublishTimesController@create')->name('inventory.publish_times.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-publish-time']], function() {
                        Route::post('update', 'IPublishTimesController@update')->name('inventory.publish_times.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-publish-time']], function() {
                        Route::post('delete', 'IPublishTimesController@delete')->name('inventory.publish_times.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-publish-time']], function() {
                            Route::get('createIPublishTimeModal', 'IPublishTimesController@createIPublishTimeModal')->name('inventory.publish_times.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-publish-time']], function() {
                            Route::get('UpdateIPublishTimeModal/{id?}', 'IPublishTimesController@UpdateIPublishTimeModal')->name('inventory.publish_times.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'phases'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-phases']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IPhasesController@index')->name('inventory.phases.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-phase']], function() {
                        Route::post('store', 'IPhasesController@store')->name('inventory.phases.store');
                        Route::get('create', 'IPhasesController@create')->name('inventory.phases.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-phase']], function() {
                        Route::post('update', 'IPhasesController@update')->name('inventory.phases.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-phase']], function() {
                        Route::post('delete', 'IPhasesController@delete')->name('inventory.phases.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-phase']], function() {
                            Route::get('createPhaseModal', 'IPhasesController@createPhaseModal')->name('inventory.phases.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-position']], function() {
                            Route::get('UpdatePhaseModal/{id?}', 'IPhasesController@UpdatePhaseModal')->name('inventory.phases.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'floor-numbers'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-floor-numbers']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IFloorNumbersController@index')->name('inventory.floor_numbers.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-floor-number']], function() {
                        Route::post('store', 'IFloorNumbersController@store')->name('inventory.floor_numbers.store');
                        Route::get('create', 'IFloorNumbersController@create')->name('inventory.floor_numbers.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-floor-number']], function() {
                        Route::post('update', 'IFloorNumbersController@update')->name('inventory.floor_numbers.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-floor-number']], function() {
                        Route::post('delete', 'IFloorNumbersController@delete')->name('inventory.floor_numbers.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-floor-number']], function() {
                            Route::get('createIFloorNumberModal', 'IFloorNumbersController@createIFloorNumberModal')->name('inventory.floor_numbers.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-floor-number']], function() {
                            Route::get('UpdateIFloorNumberModal/{id?}', 'IFloorNumbersController@UpdateIFloorNumberModal')->name('inventory.floor_numbers.modals.update');
                        });
                    });
                });
                Route::group(['prefix' => 'design-types'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-design-types']], function() {
                        Route::match(['GET', 'POST'], 'index', 'IDesignTypesController@index')->name('inventory.design_types.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-design-type']], function() {
                        Route::post('store', 'IDesignTypesController@store')->name('inventory.design_types.store');
                        Route::get('create', 'IDesignTypesController@create')->name('inventory.design_types.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-design-type']], function() {
                        Route::post('update', 'IDesignTypesController@update')->name('inventory.design_types.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-design-type']], function() {
                        Route::post('delete', 'IDesignTypesController@delete')->name('inventory.design_types.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-design-type']], function() {
                            Route::get('createIDesignTypeModal', 'IDesignTypesController@createIDesignTypeModal')->name('inventory.design_types.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-design-type']], function() {
                            Route::get('UpdateIDesignTypeModal/{id?}', 'IDesignTypesController@UpdateIDesignTypeModal')->name('inventory.design_types.modals.update');
                        });
                    });
                });

                Route::group(['prefix' => 'sell-requests'], function() {
                    Route::group(['middleware' => ['hasPermission:index-inventory-sell-requests']], function() {
                        Route::get('show/{id}', 'ISellRequestsController@show')->name('inventory.sell_requests.show');                 
                        Route::match(['GET', 'POST'], 'index', 'ISellRequestsController@index')->name('inventory.sell_requests.index');
                    });
                    Route::group(['middleware' => ['hasPermission:create-inventory-sell-request']], function() {
                        Route::post('store', 'ISellRequestsController@store')->name('inventory.sell_requests.store');
                        Route::get('create', 'ISellRequestsController@create')->name('inventory.sell_requests.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-inventory-sell-request']], function() {
                        Route::post('update', 'ISellRequestsController@update')->name('inventory.sell_requests.update');
                    });
                    Route::group(['middleware' => ['hasPermission:delete-inventory-sell-request']], function() {
                        Route::post('delete', 'ISellRequestsController@delete')->name('inventory.sell_requests.delete');
                    });
                    Route::group(['perfix' => 'modals'], function() {
                        Route::group(['middleware' => ['hasPermission:create-inventory-sell-request']], function() {
                            Route::get('createISellRequestModal', 'ISellRequestsController@createISellRequestModal')->name('inventory.sell_requests.modals.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-inventory-sell-request']], function() {
                            Route::get('UpdateISellRequestModal/{id?}', 'ISellRequestsController@UpdateISellRequestModal')->name('inventory.sell_requests.modals.update');
                        });
                    });
                });

            });
        });
    });

    Route::group(['prefix' =>'', 'middleware' => ['web', 'auth']], function() {
        Route::prefix('inventory')->group(function() {
            Route::group(['middleware' => []], function() {
                Route::group(['prefix' => 'favorites'], function () {
                    Route::post('store', 'IFavoritesController@store')->name('favorites.store');
                    Route::post('delete', 'IFavoritesController@destroy');
                });
                Route::group(['prefix' => 'projects'], function() {
                    Route::post('select','IProjectsController@selectProject')->name('inventory.projects.select');
                });
                Route::get('tagsinput', 'IProjectsController@tagsinput')->name('inventory.projects.tagsinput');
            });
        });
    });

    Route::group(['prefix' =>'', 'middleware' => ['web']], function() {
        Route::prefix('inventory')->group(function() {
            Route::group(['middleware' => []], function() {
                Route::group(['prefix' => 'purpose_types'], function() {
                    Route::get('GetIPurposePurposeTypes', 'IPurposeTypesController@GetIPurposePurposeTypes')->name('inventory.purpose_types.GetIPurposePurposeTypes');
                });

            });
        });
    });
});