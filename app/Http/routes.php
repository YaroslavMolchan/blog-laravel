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

Route::get('/', 'ArticlesController@index');

Route::post('articles/createComment/{id}', 'ArticlesController@createComment');
Route::post('articles/deleteComment', 'ArticlesController@deleteComment');
Route::post('articles/urlComment', 'ArticlesController@urlComment');

Route::get('{Y}/{m}/{d}/{alias}', 'ArticlesController@show');

Route::resource('articles', 'ArticlesController');
Route::resource('categories', 'CategoriesController');
Route::resource('tags', 'TagsController');

Route::post('upload/imageUpload', 'UploadController@imageUpload');
Route::get('upload/imageManager', 'UploadController@imageManager');

Route::post('upload/fileUpload', 'UploadController@fileUpload');
Route::get('upload/fileManager', 'UploadController@fileManager');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
