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
        Route::group(['middleware' => ['auth:api', 'HasSettingsModule']], function () {
            /*************************************************************************
             * FOOTER LINKS
             *************************************************************************/
            Route::group(['prefix' => 'footer_links'], function () {
                Route::get('/', 'FooterLinksController@index');
                Route::post('store', 'FooterLinksController@store');
                Route::post('update', 'FooterLinksController@update');
                Route::post('delete', 'FooterLinksController@delete');
            });
            /*************************************************************************
             * LOGOS
             *************************************************************************/
            Route::group(['prefix' => 'logos'], function () {
                Route::get('/', 'LogosController@index');
                Route::post('store', 'LogosController@store');
                Route::post('update', 'LogosController@update');
                Route::post('delete', 'LogosController@delete');
            });
            /*************************************************************************
             * CONTACTS
             *************************************************************************/
            Route::group(['prefix' => 'contacts'], function () {
                Route::get('/', 'ContactsController@index');
                Route::post('store', 'ContactsController@store');
                Route::post('update', 'ContactsController@update');
                Route::post('delete', 'ContactsController@delete');
            });
            /*************************************************************************
             * TOP AGENTS
             *************************************************************************/
            Route::group(['prefix' => 'top_agents'], function () {
                Route::get('/', 'TopAgentsController@index');
                Route::post('store', 'TopAgentsController@store');
                Route::post('update', 'TopAgentsController@update');
                Route::post('delete', 'TopAgentsController@delete');
            });
            /*************************************************************************
             * MAIN SLIDERS
             *************************************************************************/
            Route::group(['prefix' => 'main_sliders'], function () {
                Route::get('/', 'MainSlidersController@index');
                Route::post('store', 'MainSlidersController@store');
                Route::post('update', 'MainSlidersController@update');
                Route::post('delete', 'MainSlidersController@delete');
            });
            /*************************************************************************
             * BRANCHES
             *************************************************************************/
            Route::group(['prefix' => 'branches'], function () {
                Route::get('/', 'BranchesController@index');
                Route::post('store', 'BranchesController@store');
                Route::post('update', 'BranchesController@update');
                Route::post('delete', 'BranchesController@delete');
            });
        });
    });
});
