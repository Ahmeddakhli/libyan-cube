<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        Route::group(['middleware' => ['auth:api']], function () {
            /*************************************************************************
             * AUTHENTICATION
             *************************************************************************/
            Route::group(['prefix' => 'auth'], function () {
                Route::post('logout', 'AuthController@logout');
                Route::get('user', 'AuthController@user');
            });

            /*************************************************************************
             * GROUPS
             *************************************************************************/
            Route::group(['prefix' => 'groups'], function () {
                Route::post('store', 'GroupsController@store');
                Route::get('all', 'GroupsController@all');
                Route::post('update', 'GroupsController@update');
                Route::post('updateGroupPermissions', 'GroupsController@updateGroupPermissions');
                Route::post('delete', 'GroupsController@delete');
            });

            /*************************************************************************
             * Users
             *************************************************************************/
            Route::group(['prefix' => 'users'], function () {
                Route::get('all', 'UsersController@all');
                Route::get('getUserById', 'UsersController@getUserById');
                Route::post('update', 'UsersController@update');
                Route::post('updatePassword', 'UsersController@updatePassword');
                Route::post('updateUserPermissions', 'UsersController@updateUserPermissions');
                Route::post('delete', 'UsersController@delete');
                Route::post('updateCustomData', 'UsersController@updateCustomData');
            });
        });
        Route::group(['middleware' => []], function () {
            /*************************************************************************
             * AUTHENTICATION
             *************************************************************************/
            Route::group(['prefix' => 'auth'], function () {
                Route::post('register', 'AuthController@register');
                Route::post('login', 'AuthController@login');
            });

            /*************************************************************************
             * Socket
             *************************************************************************/
            Route::group(['prefix' => 'socket'], function () {
                Route::post('setConnectionId', 'SocketController@setConnectionId');
                Route::post('unsetConnectionId', 'SocketController@unsetConnectionId');
            });
        });
    });
});
