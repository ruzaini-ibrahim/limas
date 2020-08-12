<?php

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
//member route
Route::middleware('auth:web')->group( function(){
	Route::get('/', 'HomeController@index')->name('home');
});

// admin route
Route::get('admin/login', 'AdminLoginController@showLoginForm')->name('admin.loginForm');
Route::post('admin/login', 'AdminLoginController@login')->name('admin.loginPost');
Route::post('admin/logout', 'AdminLoginController@logout')->name('admin.logout');

Route::prefix('admin')->middleware('auth:admin')->group( function(){

	//dashboard
	Route::get('/', 'DashboardController@index')->name('admin.dashboard');

	//users
	//member
	Route::get('user/records', 'UserController@records');
	Route::resource('user','UserController');

	//admin
	Route::get('administrator/records', 'AdminController@records');
	Route::resource('administrator','AdminController');

	//book management
	//books
	Route::post('book/coverAdd', 'BookController@coverAdd');
	Route::get('book/records', 'BookController@records');
	Route::get('book/{id}/test', 'BookController@test');
	Route::get('book/{id}/book-item', 'BookController@showBookItemRecords');
	Route::resource('book','BookController');

	//checkout
	Route::post('checkout/getBookItem', 'CheckoutController@getBookItem');
	Route::get('checkout/recordsLender', 'CheckoutController@recordsLender');
	Route::get('checkout/records', 'CheckoutController@records');
	Route::get('checkout/{id}/showCreateModal', 'CheckoutController@showCreateModal');
	Route::resource('checkout','CheckoutController');

	//return
	Route::get('return/recordsLender', 'ReturnController@recordsLender');
	Route::get('return/recordsReturn', 'ReturnController@recordsReturn');
	Route::get('return/{id}/showCreateModal', 'ReturnController@showCreateModal');
	Route::resource('return','ReturnController');


	//fine
	Route::get('fine/showPaymentModal', 'FineController@showPaymentModal');
	Route::get('fine/recordsLender', 'FineController@recordsLender');
	Route::get('fine/recordsFine', 'FineController@recordsFine');
	Route::resource('fine','FineController');


	//categories
	Route::get('category/records', 'CategoryController@records');
	Route::resource('category','CategoryController');

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
