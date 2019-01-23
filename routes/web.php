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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    
    // Authentication Routes...
    $this->get('/login', 'LoginController@showLoginForm')->name('login');
    $this->post('/login', 'LoginController@login');
    $this->get('/logout', 'LoginController@logout')->name('logout');
    $this->get('/dashboard', 'DashboardController@index')->name('dashboard');
    
    $this->get('/products', 'DashboardController@index')->name('auth_products');
    $this->get('/banners', 'DashboardController@index')->name('auth_banners');
    $this->get('/contacts', 'DashboardController@index')->name('auth_contacts');
    $this->get('/config', 'DashboardController@index')->name('auth_config');
    
    // Vendors
    $this->get('/vendors', 'VendorsController@index')->name('auth_vendors');
    Route::match(['get', 'post'], '/vendors/create', 'VendorsController@create')->name('auth_vendors_create');
    Route::match(['get', 'post'], '/vendors/edit/{id}', 'VendorsController@edit')->name('auth_vendors_edit');
    Route::match(['get', 'post'], '/search_vendor', 'VendorsController@search')->name('auth_vendors_search');
    Route::get('/vendors/remove/{id}', 'VendorsController@remove')->name('auth_vendors_remove');
    
    // Categories
    $this->get('/categories', 'CategoriesController@index')->name('auth_categories');
    Route::match(['get', 'post'], '/categories/create', 'CategoriesController@create')->name('auth_categories_create');
    Route::match(['get', 'post'], '/categories/edit/{id}', 'CategoriesController@edit')->name('auth_categories_edit');
    Route::match(['get', 'post'], '/search_category', 'CategoriesController@search')->name('auth_categories_search');
    Route::get('/categories/remove/{id}', 'CategoriesController@remove')->name('auth_categories_remove');
    
    
    // Registration Routes...
//     $this->get('/register', 'RegisterController@showRegistrationForm')->name('register');
//     $this->post('/register', 'RegisterController@register');
    
    // Password Reset Routes...
//     $this->get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//     $this->post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     $this->get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//     $this->post('/password/reset', 'ResetPasswordController@reset');
    
});



