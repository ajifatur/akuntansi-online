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

// Home
Route::get('/', function () {
    return view('welcome');
})->name('site.home');

// Jurnal Umum
Route::get('/admin/kas', 'KasController@index');

// Neraca
Route::get('/admin/balancesheet/standard', 'BalanceSheetController@standard');

/*
// Login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('/login', 'Auth\LoginController@login')->name('auth.postlogin');

// Register
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::post('/register', 'Auth\RegisterController@register')->name('auth.postregister');

// Admin Capabilities
Route::group(['middleware' => ['admin']], function(){
	// Logout
	Route::post('/admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

	// Dashboard
	Route::get('/admin', 'DashboardController@admin')->name('admin.dashboard');

	// Package
	Route::get('/admin/package', 'PackageController@index')->name('admin.package.index');
	Route::get('/admin/package/create', 'PackageController@create')->name('admin.package.create');
	Route::post('/admin/package/store', 'PackageController@store')->name('admin.package.store');
	Route::get('/admin/package/edit/{id}', 'PackageController@edit')->name('admin.package.edit');
	Route::post('/admin/package/update', 'PackageController@update')->name('admin.package.update');
	Route::post('/admin/package/delete', 'PackageController@delete')->name('admin.package.delete');

	// Subscriber
	Route::get('/admin/subscriber', 'SubscriberController@index')->name('admin.subscriber.index');
	Route::get('/admin/subscriber/create', 'SubscriberController@create')->name('admin.subscriber.create');
	Route::post('/admin/subscriber/store', 'SubscriberController@store')->name('admin.subscriber.store');
	Route::get('/admin/subscriber/edit/{id}', 'SubscriberController@edit')->name('admin.subscriber.edit');
	Route::post('/admin/subscriber/update', 'SubscriberController@update')->name('admin.subscriber.update');
	Route::post('/admin/subscriber/delete', 'SubscriberController@delete')->name('admin.subscriber.delete');
	Route::get('/admin/subscriber/update-remote', 'SubscriberController@updateRemote')->name('admin.subscriber.update-remote');
});

// Member Capabilities
Route::group(['middleware' => ['member']], function(){
	// Logout
	Route::post('/member/logout', 'Auth\LoginController@logout')->name('member.logout');

	// Dashboard
	Route::get('/member', function(){
        return view('template.admin.main');
    })->name('member.dashboard');

	// Profile
	Route::get('/member/profile', function(){
        //
    })->name('member.profile');
});
*/