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
            Route::prefix('settings')->group(function() {
                Route::group(['middleware' => []], function() {
                    Route::get('/', 'SettingsController@index')->name('settings.settings');
                    Route::get('index', 'SettingsController@mainSettingsIndex')->name('settings.mainSettings');
                    Route::post('update', 'SettingsController@update')->name('settings.settings.update');
                    /*************************************************************************
                     * FOOTER LINKS
                     *************************************************************************/
                    Route::group(['prefix' => 'footer-links'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-footer-links']], function() {
                            Route::match(['GET', 'POST'], 'index', 'FooterLinksController@index')->name('settings.footer_links.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-footer-link']], function() {
                            Route::post('store', 'FooterLinksController@store')->name('settings.footer_links.store');
                            Route::get('create', 'FooterLinksController@create')->name('settings.footer_links.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-footer-link']], function() {
                            Route::post('update', 'FooterLinksController@update')->name('settings.footer_links.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-footer-link']], function() {
                            Route::post('delete', 'FooterLinksController@delete')->name('settings.footer_links.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-footer-link']], function() {
                                Route::get('createFooterLinkModal', 'FooterLinksController@createFooterLinkModal')->name('settings.footer_links.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-footer-link']], function() {
                                Route::get('UpdateFooterLinkModal/{id?}', 'FooterLinksController@UpdateFooterLinkModal')->name('settings.footer_links.modals.update');
                            });
                        });
                    });
                    /*************************************************************************
                     * LOGOS
                     *************************************************************************/
                    Route::group(['prefix' => 'logos'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-logos']], function() {
                            Route::match(['GET', 'POST'], 'index', 'LogosController@index')->name('settings.logos.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-logo']], function() {
                            Route::post('store', 'LogosController@store')->name('settings.logos.store');
                            Route::get('create', 'LogosController@create')->name('settings.logos.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-logo']], function() {
                            Route::post('update', 'LogosController@update')->name('settings.logos.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-logo']], function() {
                            Route::post('delete', 'LogosController@delete')->name('settings.logos.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-logo']], function() {
                                Route::get('createLogoModal', 'LogosController@createLogoModal')->name('settings.logos.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-logo']], function() {
                                Route::get('updateLogoModal/{id?}', 'LogosController@updateLogoModal')->name('settings.logos.modals.update');
                            });
                        });
                    });
                    /*************************************************************************
                     * CONTACTS
                     *************************************************************************/
                    Route::group(['prefix' => 'contacts'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-contacts']], function() {
                            Route::match(['GET', 'POST'], 'index', 'ContactsController@index')->name('settings.contacts.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-contact']], function() {
                            Route::post('store', 'ContactsController@store')->name('settings.contacts.store');
                            Route::get('create', 'ContactsController@create')->name('settings.contacts.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-contact']], function() {
                            Route::post('update', 'ContactsController@update')->name('settings.contacts.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-contact']], function() {
                            Route::post('delete', 'ContactsController@delete')->name('settings.contacts.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-contact']], function() {
                                Route::get('createContactModal', 'ContactsController@createContactModal')->name('settings.contacts.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-contact']], function() {
                                Route::get('updateContactModal/{id?}', 'ContactsController@updateContactModal')->name('settings.contacts.modals.update');
                            });
                        });
                    });
                    /*************************************************************************
                     * MAIN SLIDERS
                     *************************************************************************/
                    Route::group(['prefix' => 'main-sliders'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-main-sliders']], function() {
                            Route::match(['GET', 'POST'], 'index', 'MainSlidersController@index')->name('settings.main_sliders.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-main-slider']], function() {
                            Route::post('store', 'MainSlidersController@store')->name('settings.main_sliders.store');
                            Route::get('create', 'MainSlidersController@create')->name('settings.main_sliders.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-main-slider']], function() {
                            Route::post('update', 'MainSlidersController@update')->name('settings.main_sliders.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-main-slider']], function() {
                            Route::post('delete', 'MainSlidersController@delete')->name('settings.main_sliders.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-main-slider']], function() {
                                Route::get('createMainSliderModal', 'MainSlidersController@createMainSliderModal')->name('settings.main_sliders.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-main-slider']], function() {
                                Route::get('updateMainSliderModal/{id?}', 'MainSlidersController@updateMainSliderModal')->name('settings.main_sliders.modals.update');
                            });
                        });
                    });
                    /*************************************************************************
                     * TOP AGENTS
                     *************************************************************************/
                    Route::group(['prefix' => 'top-agents'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-teems']], function() {
                            Route::match(['GET', 'POST'], 'index', 'TopAgentsController@index')->name('settings.top_agents.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-teem']], function() {
                            Route::post('store', 'TopAgentsController@store')->name('settings.top_agents.store');
                            Route::get('create', 'TopAgentsController@create')->name('settings.top_agents.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-teem']], function() {
                            Route::post('update', 'TopAgentsController@update')->name('settings.top_agents.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-teem']], function() {
                            Route::post('delete', 'TopAgentsController@delete')->name('settings.top_agents.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-teem']], function() {
                                Route::get('createTopAgentModal', 'TopAgentsController@createTopAgentModal')->name('settings.top_agents.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-teem']], function() {
                                Route::get('updateTopAgentModal/{id?}', 'TopAgentsController@updateTopAgentModal')->name('settings.top_agents.modals.update');
                            });
                        });
                    });
                    /*************************************************************************
                     * Branches
                     *************************************************************************/
                    Route::group(['prefix' => 'branches'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-branches']], function() {
                            Route::match(['GET', 'POST'], 'index', 'BranchesController@index')->name('settings.branches.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-branch']], function() {
                            Route::post('store', 'BranchesController@store')->name('settings.branches.store');
                            Route::get('create', 'BranchesController@create')->name('settings.branches.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-branch']], function() {
                            Route::post('update', 'BranchesController@update')->name('settings.branches.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-branch']], function() {
                            Route::post('delete', 'BranchesController@delete')->name('settings.branches.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-branch']], function() {
                                Route::get('createBranchModal', 'BranchesController@createBranchModal')->name('settings.branches.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-branch']], function() {
                                Route::get('UpdateBranchModal/{id?}', 'BranchesController@UpdateBranchModal')->name('settings.branches.modals.update');
                            });
                        });
                    });
                    /*************************************************************************
                     * MAIN SLIDERS
                     *************************************************************************/
                    Route::group(['prefix' => 'how-works'], function() {
                        Route::group(['middleware' => ['hasPermission:index-settings-how-works']], function() {
                            Route::match(['GET', 'POST'], 'index', 'HowWorksController@index')->name('settings.how_works.index');
                        });
                        Route::group(['middleware' => ['hasPermission:create-settings-how-work']], function() {
                            Route::post('store', 'HowWorksController@store')->name('settings.how_works.store');
                            Route::get('create', 'HowWorksController@create')->name('settings.how_works.create');
                        });
                        Route::group(['middleware' => ['hasPermission:update-settings-how-work']], function() {
                            Route::post('update', 'HowWorksController@update')->name('settings.how_works.update');
                        });
                        Route::group(['middleware' => ['hasPermission:delete-settings-how-work']], function() {
                            Route::post('delete', 'HowWorksController@delete')->name('settings.how_works.delete');
                        });
                        Route::group(['perfix' => 'modals'], function() {
                            Route::group(['middleware' => ['hasPermission:create-settings-how-work']], function() {
                                Route::get('createHowWorkModal', 'HowWorksController@createHowWorkModal')->name('settings.how_works.modals.create');
                            });
                            Route::group(['middleware' => ['hasPermission:update-settings-how-work']], function() {
                                Route::get('updateHowWorkModal/{id?}', 'HowWorksController@updateHowWorkModal')->name('settings.how_works.modals.update');
                            });
                        });
                    });
                });
            }); 
        });
    });