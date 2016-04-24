<?php

/*
 * |--------------------------------------------------------------------------
 * | Routes File
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you will register all of the routes in an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */

/**
 * Default route
 */
Route::get ( '/', function () {
	return view ( 'welcome' );
} );

/**
 * category route
 * 
 * for Ravy
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ( '/category', 'CategoryController@index' );
	Route::get ( '/category/view/{id}', 'CategoryController@show' );
	Route::get ( '/category/delete/{id}', 'CategoryController@destroy' );
	Route::get ( '/category/edit/{id}', 'CategoryController@edit' );
	Route::get ( '/category/search', 'CategoryController@search' );
	Route::post ( '/category/store', 'CategoryController@store' );
	Route::post ( '/category/update', 'CategoryController@update' );
});
/**
 * article route
 * 
 * for muth
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ( '/article', 'ArticleController@index' );
	Route::get ( '/article/view/{id}', 'ArticleController@show' );
	Route::get ( '/article/delete/{id}', 'ArticleController@destroy' );
	Route::get ( '/article/edit/{id}', 'ArticleController@edit' );
	Route::get ( '/article/search', 'ArticleController@search' );
	Route::post ( '/article/store', 'ArticleController@store' );
	Route::post ( '/article/update', 'ArticleController@update' );
});


/**
 * product route sample
 * 
 * for chhoin
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ( '/product', 'ProductController@index' );
	Route::get ( '/product/view/{id}', 'ProductController@show' );
	Route::get ( '/product/delete/{id}', 'ProductController@destroy' );
	Route::get ( '/product/edit/{id}', 'ProductController@edit' );
	Route::get ( '/product/search', 'ProductController@search' );
	Route::post ( '/product/store', 'ProductController@store' );
	Route::post ( '/product/update', 'ProductController@update' );
});

/**
 * test route
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ( '/test', 'TestController@index' );
});
