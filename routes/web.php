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


Route::group(['middleware' => ['web']], function() {

	// Simple Intro
	Route::get('/', function () {
		return redirect()->route('product.index');
	});

	// Multilanguage
	Route::get('/{lang}/product', 'ProductController@lang')->name('lang');
	
	// User
	Route::get('logout', 'Auth\LoginController@logout');
	Auth::routes();

	// Admin Area
	Route::resource('admin', 'AdminController');

	// Route::group(['prefix' => 'admin'], function () {
	// });

	// Category
	Route::resource('category', 'CategoryController', ['except' => ['create', 'show']]);

	// Product
	Route::resource('product', 'ProductController', ['except' => ['show']]);

	// Comment
	// Route::resource('comment', 'CommentController');

	// Add Another Language To Product
	Route::get('product/{product}/create', 'AdminController@createMultilang')->name('product.createMultilang');

	Route::post('product/{product}', 'AdminController@storeMultilang')->name('product.storeMultilang');

	Route::get('product/{product}/edit', 'AdminController@editMultilang')->name('product.editMultilang');

	Route::put('product/{product}', 'AdminController@updateMultilang')->name('product.updateMultilang');

	Route::delete('product/{product}', 'AdminController@destroyMultilang')->name('product.destroyMultilang');

	// Showing Product Single By Slug
	Route::get('product/{slug}', 'MainController@show')->name('product.show')
	->where('slug', '[\w\d\-\_]+');

	// Route::get('product', 'ProductController@getSingle')->name('product.index');

	// Comment CRUD
	Route::post('comments/{prduct_id}', 'CommentController@store')->name('comments.store');

	// Route::group(['middleware'=>'auth'], function(){
	Route::get('comments/{id}/edit', 'CommentController@edit')->name('comments.edit');
	Route::put('comments/{id}', 'CommentController@update')->name('comments.update');
	Route::get('comments/{id}/delete', 'CommentController@delete')->name('comments.delete');
	Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
	// });


	Route::get('/home', 'HomeController@index')->name('home');

});