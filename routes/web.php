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

	// Home Page
	Route::get('/', 'MainController@index')->name('home');
	Route::get('/home', 'MainController@index')->name('home');

	// Search
	Route::get('/search', 'ProductController@search')->name('search');

	// Contact
	Route::get('/contact', 'MainController@getContact');
    Route::post('/contact', 'MainController@postContact');

	// Product
	Route::resource('product', 'ProductController', ['only' => ['index']]);

	// Showing Product Single By Slug
	Route::get('product/{slug}', 'MainController@show')
		->name('product.show')
		->where('slug', '[\w\d\-\_]+');
	
	// Cart
	Route::get('cart', 'ProductController@getCart')
		->name('cart.index');
	Route::post('product/{id}/cart', 'ProductController@getAddToCart')
		->name('cart.add');
	Route::get('product/{id}/cart/reduce', 'ProductController@getReduceByOne')
		->name('cart.reduce');
	Route::get('product/{id}/cart/remove', 'ProductController@getRemoveItem')
		->name('cart.remove');

	// WishList
	Route::get('wishlist', 'ProductController@getWishList')
		->name('withlist.index');
	Route::get('wishlist/{id}/add', 'ProductController@addList')
		->name('withlist.add');
	Route::get('wishlist/{id}/remove', 'ProductController@removeList')
		->name('withlist.remove');
	
	// Checkout
	Route::group(['middleware'=>'auth'], function(){
		Route::get('checkout', 'ProductController@getCheckout')->name('checkout');
		Route::post('checkout', 'ProductController@postCheckout')->name('checkout');
	});
	
	// User
	Auth::routes();
	Route::get('logout', 'Auth\LoginController@logout');
	Route::get('user/profile', 'MainController@userProfile')
		->name('user.profile')
		->middleware('auth');

	// Multilanguage
	Route::get('/{lang}/product', 'ProductController@lang')->name('lang');

	// Admin Area
	Route::group(['middleware' => 'roles:Admin,Author'], function () {
		Route::resource('admin', 'AdminController');
		Route::get('roles', 'AdminController@getAdminPage');
		Route::post('roles', 'AdminController@AssignRole')->name('role.assign');

		// Add Another Language To Product
		Route::get('product/{product}/create', 'AdminController@createMultilang')
		->name('product.createMultilang');
		Route::post('product/{product}', 'AdminController@storeMultilang')
		->name('product.storeMultilang');
		Route::get('product/{product}/edit', 'AdminController@editMultilang')
		->name('product.editMultilang');
		Route::put('product/{product}', 'AdminController@updateMultilang')
		->name('product.updateMultilang');
		Route::delete('product/{product}', 'AdminController@destroyMultilang')
		->name('product.destroyMultilang');
		
		// Category
		Route::resource('category', 'CategoryController', ['except' => ['create', 'show']]);
	});

	Route::group(['middleware'=>'auth'], function(){
		// Comment
		Route::post('comments/{prduct_id}', 'CommentController@store')
			->name('comments.store');
			
		Route::delete('comments/{id}', 'CommentController@destroy')
			->name('comments.destroy');
	});

	Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
	Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
});