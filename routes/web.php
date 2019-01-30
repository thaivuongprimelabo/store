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
})->name('home');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    
    // Authentication Routes...
    $this->get('/login', 'LoginController@showLoginForm')->name('login');
    $this->post('/login', 'LoginController@login');
    $this->get('/logout', 'LoginController@logout')->name('logout');
    $this->get('/dashboard', 'DashboardController@index')->name('dashboard');
    
    // Products
    $this->get('/products', 'ProductsController@index')->name('auth_products');
    Route::match(['get', 'post'], '/products/create', 'ProductsController@create')->name('auth_products_create');
    Route::match(['get', 'post'], '/products/edit/{id}', 'ProductsController@edit')->name('auth_products_edit');
    Route::match(['get', 'post'], '/products/search', 'ProductsController@search')->name('auth_products_search');
    Route::get('/products/remove/{id}', 'ProductsController@remove')->name('auth_products_remove');
    
    // Vendors
    $this->get('/vendors', 'VendorsController@index')->name('auth_vendors');
    Route::match(['get', 'post'], '/vendors/create', 'VendorsController@create')->name('auth_vendors_create');
    Route::match(['get', 'post'], '/vendors/edit/{id}', 'VendorsController@edit')->name('auth_vendors_edit');
    Route::match(['get', 'post'], '/vendors/search', 'VendorsController@search')->name('auth_vendors_search');
    Route::get('/vendors/remove/{id}', 'VendorsController@remove')->name('auth_vendors_remove');
    
    // Categories
    $this->get('/categories', 'CategoriesController@index')->name('auth_categories');
    Route::match(['get', 'post'], '/categories/create', 'CategoriesController@create')->name('auth_categories_create');
    Route::match(['get', 'post'], '/categories/edit/{id}', 'CategoriesController@edit')->name('auth_categories_edit');
    Route::match(['get', 'post'], '/categories/search', 'CategoriesController@search')->name('auth_categories_search');
    Route::match(['get', 'post'], '/categories/remove/{id?}', 'CategoriesController@remove')->name('auth_categories_remove');
    
    // Banners
    $this->get('/banners', 'BannersController@index')->name('auth_banners');
    Route::match(['get', 'post'], '/banners/create', 'BannersController@create')->name('auth_banners_create');
    Route::match(['get', 'post'], '/banners/edit/{id}', 'BannersController@edit')->name('auth_banners_edit');
    Route::match(['get', 'post'], '/banners/search', 'BannersController@search')->name('auth_banners_search');
    Route::get('/banners/remove/{id}', 'BannersController@remove')->name('auth_banners_remove');
    
    // Contacts
    $this->get('/contacts', 'ContactsController@index')->name('auth_contacts');
    Route::match(['get', 'post'], '/contacts/create', 'ContactsController@create')->name('auth_contacts_create');
    Route::match(['get', 'post'], '/contacts/edit/{id}', 'ContactsController@edit')->name('auth_contacts_edit');
    Route::match(['get', 'post'], '/contacts/search', 'ContactsController@search')->name('auth_contacts_search');
    Route::get('/contacts/remove/{id}', 'ContactsController@remove')->name('auth_contacts_remove');
    
    // Posts
    $this->get('/posts', 'PostsController@index')->name('auth_posts');
    Route::match(['get', 'post'], '/posts/create', 'PostsController@create')->name('auth_posts_create');
    Route::match(['get', 'post'], '/posts/edit/{id}', 'PostsController@edit')->name('auth_posts_edit');
    Route::match(['get', 'post'], '/posts/search', 'PostsController@search')->name('auth_posts_search');
    Route::get('/posts/remove/{id}', 'PostsController@remove')->name('auth_posts_remove');
    
    // Users
    $this->get('/users', 'UsersController@index')->name('auth_users');
    Route::match(['get', 'post'], '/users/create', 'UsersController@create')->name('auth_users_create');
    Route::match(['get', 'post'], '/users/edit/{id}', 'UsersController@edit')->name('auth_users_edit');
    Route::match(['get', 'post'], '/users/search', 'UsersController@search')->name('auth_users_search');
    Route::get('/users/remove/{id}', 'UsersController@remove')->name('auth_users_remove');
    
    // Config
    Route::match(['get', 'post'], '/config', 'ConfigController@index')->name('auth_config_edit');
    
    // Profile
    Route::match(['get', 'post'], '/profile', 'UsersController@profile')->name('auth_profile');
    
    // Registration Routes...
//     $this->get('/register', 'RegisterController@showRegistrationForm')->name('register');
//     $this->post('/register', 'RegisterController@register');
    
    // Password Reset Routes...
//     $this->get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//     $this->post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     $this->get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//     $this->post('/password/reset', 'ResetPasswordController@reset');
    
});



