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
    
    $this->get('/products', 'DashboardController@index')->name('auth_product');
    $this->get('/categories', 'DashboardController@index')->name('auth_category');
    $this->get('/vendors', 'VendorsController@index')->name('auth_vendor');
    $this->get('/banners', 'DashboardController@index')->name('auth_banner');
    $this->get('/contacts', 'DashboardController@index')->name('auth_contact');
    $this->get('/config', 'DashboardController@index')->name('auth_config');
    
    $this->get('/search_vendor', 'VendorsController@search')->name('auth_vendor_search');
    $this->post('/search_vendor', 'VendorsController@search')->name('auth_vendor_search');
    // Registration Routes...
//     $this->get('/register', 'RegisterController@showRegistrationForm')->name('register');
//     $this->post('/register', 'RegisterController@register');
    
    // Password Reset Routes...
//     $this->get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//     $this->post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     $this->get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//     $this->post('/password/reset', 'ResetPasswordController@reset');
    
});



