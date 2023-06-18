<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

use Modules\Inventory\IDeveloperTranslation;
use Modules\Inventory\IProjectTranslation;
use Modules\Locations\LocationTranslation;

// Auth::routes(['verify' => true]);
Route::get('test', function () {
    phpinfo();
});
Route::get('fixAll', function () {
    $projects = IProjectTranslation::whereNull('deleted_at')->get();
    $locations = LocationTranslation::whereNull('deleted_at')->get();

    foreach ($projects as $project) {
        IProjectTranslation::where('i_project_id', $project->id)->where('language_id', 1)->update([
            'second_title' => $project->project
        ]);
    }
    foreach ($locations as $location) {
        LocationTranslation::where('location_id', $location->id)->where('language_id', 1)->update([
            'second_title' => $location->name
        ]);
    }

    return $projects;
});
Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Web'], function () {
    /*************************************************************************
     * AUTHENTICATION
     *************************************************************************/
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('logout', 'AuthController@logoutGetRequest')->name('logoutGetRequest');
        Route::post('keepalive', 'AuthController@keepalive')->name('keepalive');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace' => 'Web'
    ],
    function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'isAdmin']], function () {
            /*************************************************************************
             * AUTHENTICATION
             *************************************************************************/
            Route::group(['prefix' => 'auth'], function () {
                Route::get('user', 'AuthController@user');
            });

            /*************************************************************************
             * GROUPS
             *************************************************************************/
            Route::group(['prefix' => 'groups'], function () {
                Route::group(['middleware' => ['hasPermission:create-group']], function () {
                    Route::post('store', 'GroupsController@store')->name('groups.store');
                    Route::get('create', 'GroupsController@create')->name('groups.create');
                });
                Route::group(['middleware' => ['hasPermission:index-groups']], function () {
                    Route::get('all', 'GroupsController@all')->name('groups.all');
                    Route::match(['GET', 'POST'], 'index', 'GroupsController@index')->name('groups.index');
                });
                Route::group(['middleware' => ['hasPermission:update-group']], function () {
                    Route::post('update', 'GroupsController@update')->name('groups.update');
                });
                Route::group(['middleware' => ['hasPermission:update-group-permissions']], function () {
                    Route::post('updateGroupPermissions', 'GroupsController@updateGroupPermissions')->name('groups.updateGroupPermissions');
                });

                Route::group(['middleware' => ['hasPermission:delete-group']], function () {
                    Route::post('delete', 'GroupsController@delete')->name('groups.delete');
                });
                Route::group(['perfix' => 'modals'], function () {
                    Route::group(['middleware' => ['hasPermission:create-group']], function () {
                        Route::get('createModal', 'GroupsController@createModal')->name('groups.modals.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-group']], function () {
                        Route::get('updateGroupModal/{id?}', 'GroupsController@updateGroupModal')->name('groups.modals.update');
                    });
                    Route::group(['middleware' => ['hasPermission:update-group-permissions']], function () {
                        Route::get('updateGroupPermisisonsModal/{id?}', 'GroupsController@updateGroupPermissionsModal')->name('groups.modals.updatePermissions');
                    });
                });
            });

            /*************************************************************************
             * Users
             *************************************************************************/
            Route::group(['prefix' => 'users'], function () {
                Route::group(['middleware' => ['hasPermission:create-user']], function () {
                    Route::post('store', 'UsersController@store')->name('users.store');
                    Route::get('create', 'UsersController@create')->name('users.create');
                });
                Route::group(['middleware' => ['hasPermission:index-users']], function () {
                    Route::get('all', 'UsersController@all')->name('users.all');
                    Route::match(['GET', 'POST'], 'index', 'UsersController@index')->name('users.index');
                });
                Route::get('getUserById', 'UsersController@getUserById')->name('users.getUserById');
                Route::group(['middleware' => ['hasPermission:update-user']], function () {
                });
                Route::post('update', 'UsersController@update')->name('users.update');
                Route::post('suspend', 'UsersController@suspend')->name('users.suspend');
                Route::post('unsuspend', 'UsersController@unsuspend')->name('users.unSuspend');
                Route::post('updatePassword', 'UsersController@updatePassword')->name('users.updatePassword');
                Route::post('updateCustomData', 'UsersController@updateCustomData')->name('users.updateCustomData');
                Route::group(['middleware' => ['hasPermission:update-user-permissions']], function () {
                    Route::post('updateUserPermissions', 'UsersController@updateUserPermissions')->name('users.updateUserPermissions');
                });
                Route::group(['middleware' => ['hasPermission:delete-user']], function () {
                    Route::post('delete', 'UsersController@delete')->name('users.delete');
                });
                Route::get('profile', 'UsersController@userProfile')->name('users.my-profile');
                Route::group(['perfix' => 'modals'], function () {
                    Route::group(['middleware' => ['hasPermission:create-user']], function () {
                        Route::get('createModal', 'UsersController@createModal')->name('users.modals.create');
                    });
                    Route::group(['middleware' => ['hasPermission:update-user']], function () {
                        Route::get('updateUserModal/{id?}', 'UsersController@updateUserModal')->name('users.modals.update');
                    });
                    Route::group(['middleware' => ['hasPermission:suspend-user']], function () {
                        Route::get('suspendUserModal/{id?}', 'UsersController@suspendUserModal')->name('users.modals.suspend');
                    });
                    Route::group(['middleware' => ['hasPermission:update-user-permissions']], function () {
                        Route::get('updateUserPermisisonsModal/{id?}', 'UsersController@updateUserPermissionsModal')->name('users.modals.updatePermissions');
                    });
                });
                Route::get('taginput', 'UsersController@userTagSearch')->name('users.tagsinput');
            });
        });

        Route::group(['middleware' => ['web', 'guest']], function () {
            /*************************************************************************
             * DEFAULT
             *************************************************************************/
            Route::get('login', 'AuthController@showLoginForm');

            /*************************************************************************
             * AUTHENTICATION
             *************************************************************************/
            Route::group(['prefix' => 'auth'], function () {
                Route::get('login', 'AuthController@showLoginForm')->name('login');
                Route::post('login', 'AuthController@login');
                Route::post('register', 'AuthController@register');
                Route::get('password/reset', 'AuthController@showLinkRequestForm')->name('password.request');
                Route::post('password/email', 'AuthController@sendResetLinkEmail')->name('password.email');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
                Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
            });
        });

        /**************************************************************************
         * FRONT
         **************************************************************************/
        Route::group(['namespace' => 'Front'], function () {
            /*************************************************************************
             * HOME
             *************************************************************************/
            Route::get('/', 'HomeController@index')->name('front.home');
            Route::post('/storeFireMessages', 'HomeController@storeFireMessages')->name('front.fire_messages_store');
            Route::post('/sellRequest', 'HomeController@sell')->name('front.home.sell_request.store');
            Route::get('/sell-property', 'HomeController@sellProperty')->name('front.sellProperty');

            /*************************************************************************
             * ABOUT US
             *************************************************************************/
            Route::get('/about', 'HomeController@about')->name('front.about');

            /*************************************************************************
             * Terms
             *************************************************************************/
            Route::get('/terms', 'TermsController@index')->name('front.terms');
            Route::get('/privacies', 'TermsController@indexPrivacy')->name('front.privacies');

            /*************************************************************************
             * How Works
             *************************************************************************/
            Route::get('/how-works', 'HowWorksController@index')->name('front.how_works');

            /*************************************************************************
             * CONTACT AGENT
             *************************************************************************/
            Route::post('send/message', 'UnitsController@messageUnitOwner')->name('front.message_unit_owner');
            Route::get('/thank-you', 'HomeController@thankYou')->name('front.thankYou');
            Route::get('/sell-thank-you/{name}', 'HomeController@sellThankYou')->name('front.sellThankYou');

            // location search
            Route::get('/location/{search?}', 'HomeController@locationSearch')->name('front.home.location.search');

            /*************************************************************************
             * HOME SEARCH
             *************************************************************************/
            Route::get('/search', 'SearchController@search')->name('front.search');
            Route::get('/projects', 'SearchController@projects')->name('front.projects');
            Route::get('/properties', 'SearchController@properties')->name('front.properties');
            Route::get('/resale', 'SearchController@resale')->name('front.resale');
            Route::get('/locations/{type?}-{id}-{slug?}', 'SearchController@locations')->name('front.locations.show');
            Route::get('/areas/{id}-{slug?}', 'SearchController@projectsLocations')->name('front.areas.show');


            /*************************************************************************
             * PROJECT
             *************************************************************************/
            Route::get('/projects/{id}-{slug?}', 'ProjectsController@show')->name('front.singleProject');
            Route::get('/published-projects/{publish_id}', 'ProjectsController@publish')->name('front.publishedProject');

            /*************************************************************************
             * UNIT
             *************************************************************************/
            Route::get('/properties/{id}/{title?}', 'UnitsController@show')->name('front.singleUnit');
            Route::get('projects/properties/{project_id}-{title?}', 'SearchController@properties')->name('front.project.properties');

            /*************************************************************************
             * CAREERS
             *************************************************************************/
            Route::get('/careers', 'CareersController@index')->name('front.careers');
            Route::get('/careers/{id}/{slug?}', 'CareersController@show')->name('front.careerSingle');

            /*************************************************************************
             * USER PROFILE
             *************************************************************************/
            Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'profile'], function () {
                Route::get('/add-unit', 'UsersController@addunit')->name('front.profile.addunit');
                Route::post('/add-unit', 'UnitsController@store')->name('front.profile.addunit.store');
                Route::get('/my-units', 'UnitsController@myunits')->name('front.profile.myunits');
                Route::get('/info', 'UsersController@index')->name('front.profile.info');
                Route::post('/update', 'UsersController@update')->name('front.users.update');
                Route::get('/favourite-units', 'UsersController@favorites')->name('front.profile.favorites');
            });

            /*************************************************************************
             * DEVELOPERS
             *************************************************************************/
            Route::get('/developers', 'DevelopersController@index')->name('front.developers');
            Route::get('/developers/{id}-{slug?}', 'DevelopersController@show')->name('front.developers.show');
            Route::get('/developer/{keyword}', 'DevelopersController@showKeyword')->name('front.developers.show.keyword');

            /*************************************************************************
             * COMPARES
             *************************************************************************/
            Route::group(['prefix' => 'compares'], function () {
                Route::get('/', 'ComparesController@index')->name('front.compares');
                Route::post('/export', 'ComparesController@export')->name('front.compares.export');
                Route::post('/export', 'ComparesController@export')->name('front.compares.export');
                Route::post('/change-order', 'ComparesController@changeOrder')->name('front.compare.change_order');
                Route::get('/reload', 'ComparesController@reload')->name('front.compares.reload');
            });

            /*************************************************************************
             * CONTACT US
             *************************************************************************/
            Route::get('/contact-us', 'ContactUsController@index')->name('front.contact-us');
            Route::post('/contact-us/subscribe', 'ContactUsController@subscribe')->name('front.subscribe');

            /*************************************************************************
             * BLOG
             *************************************************************************/
            Route::get('/blogs/{category_slug?}', 'BlogsController@index')->name('front.blogs');
            Route::get('/blog/{id}-{slug?}', 'BlogsController@show')->name('front.single_blog');

            /*************************************************************************
             * DESIGN TYPE
             *************************************************************************/
            Route::get('/unit-type/{id}/{title?}', 'UnitsController@designType')->name('front.unit_type');

            /*************************************************************************
             * SERVICES
             *************************************************************************/
            Route::get('/services', 'ServicesController@index')->name('front.services');
        });

        /**************************************************************************
         * GUEST
         **************************************************************************/
        Route::group(['middleware' => ['guest']], function () {
            Route::group(['namespace' => 'Front'], function () {
                Route::get('login', 'HomeController@login')->name('front.login');
            });
            Route::post('login', 'AuthController@login')->name('front.login');

            Route::post('register', 'AuthController@register')->name('register');
        });

        /*************************************************************************
         * LANDING PAGE
         *************************************************************************/
        Route::get('landing/{id}/{slug?}', 'LandingPagesController@index')->name('landing');
    }
);
