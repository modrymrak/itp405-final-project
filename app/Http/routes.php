<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    // Authentication and Registration routes, not needed explicitly with
    //authentication controllers but added for clarity
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
    //Routes to rest of application
    Route::get('/', 'HomeController@index');
    Route::post('/', 'HomeController@search');
    Route::get('/new', 'MainController@newArticle');
    Route::post('/new', 'MainController@addArticle');
    Route::get('/article/{id}', 'MainController@articleDetails');
    Route::post('/article/{id}', 'MainController@newComment');
    Route::get('/admin', 'AdminController@index');
    Route::post('/admin', 'AdminController@select');
    Route::post('/delete/{id}', 'AdminController@deleteItem');
    Route::get('/guardian', 'GuardianController@index');
    Route::post('/guardian', 'GuardianController@search');
});
