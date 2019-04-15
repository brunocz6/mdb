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

Route::get('/', "MoviesController@index");

Route::resource('movieCategories', 'MovieCategoriesController')->except(['index', 'show']);
Route::resource('movieRatings', 'MovieRatingsController')->except(['create', 'edit', 'update', 'show']);
Route::resource('movies', 'MoviesController');

Route::get('movies/index/{categoryId}', ['as' => 'movies.index', 'uses' => 'MoviesController@index']);
Route::get('/top', 'MoviesController@top')->name('movies.top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');

Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');