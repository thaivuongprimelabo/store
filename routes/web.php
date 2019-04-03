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
use App\Config;

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    
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
    
    Route::get('/products/sizes', 'ProductsController@sizes')->name('auth_products_sizes');
    Route::get('/products/sizes/remove/{id}', 'ProductsController@removeSize')->name('auth_products_sizes_remove');
    
    Route::get('/products/colors', 'ProductsController@colors')->name('auth_products_colors');
    Route::get('/products/colors/remove/{id}', 'ProductsController@removeColor')->name('auth_products_colors_remove');
    
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
    Route::match(['get', 'post'], '/contacts/edit/{id}', 'ContactsController@edit')->name('auth_contacts_edit');
    Route::match(['get', 'post'], '/contacts/search', 'ContactsController@search')->name('auth_contacts_search');
    Route::get('/contacts/remove/{id}', 'ContactsController@remove')->name('auth_contacts_remove');
    
    // Posts
    $this->get('/posts', 'PostsController@index')->name('auth_posts');
    Route::match(['get', 'post'], '/posts/create', 'PostsController@create')->name('auth_posts_create');
    Route::match(['get', 'post'], '/posts/edit/{id}', 'PostsController@edit')->name('auth_posts_edit');
    Route::match(['get', 'post'], '/posts/search', 'PostsController@search')->name('auth_posts_search');
    Route::get('/posts/remove/{id}', 'PostsController@remove')->name('auth_posts_remove');
    
    $this->get('/post_groups', 'PostGroupsController@index')->name('auth_postgroups');
    Route::match(['get', 'post'], '/post_groups/create', 'PostGroupsController@create')->name('auth_postgroups_create');
    Route::match(['get', 'post'], '/post_groups/edit/{id}', 'PostGroupsController@edit')->name('auth_postgroups_edit');
    Route::match(['get', 'post'], '/post_groups/search', 'PostGroupsController@search')->name('auth_postgroups_search');
    Route::get('/post_groups/remove/{id}', 'PostGroupsController@remove')->name('auth_postgroups_remove');
    
    // Orders
    $this->get('/orders', 'OrdersController@index')->name('auth_orders');
    Route::match(['get', 'post'], '/orders/edit/{id}', 'OrdersController@edit')->name('auth_orders_edit');
    Route::match(['get', 'post'], '/orders/search', 'OrdersController@search')->name('auth_orders_search');
    
    // Users
    $this->get('/users', 'UsersController@index')->name('auth_users');
    Route::match(['get', 'post'], '/users/create', 'UsersController@create')->name('auth_users_create');
    Route::match(['get', 'post'], '/users/edit/{id}', 'UsersController@edit')->name('auth_users_edit');
    Route::match(['get', 'post'], '/users/search', 'UsersController@search')->name('auth_users_search');
    Route::get('/users/remove/{id}', 'UsersController@remove')->name('auth_users_remove');
    
    // Config
    Route::match(['get', 'post'], '/config', 'ConfigController@index')->name('auth_config');
    
    // Profile
    Route::match(['get', 'post'], '/profile', 'UsersController@profile')->name('auth_profile');
    
    // Pages
    $this->get('/pages', 'PagesController@index')->name('auth_pages');
    Route::match(['get', 'post'], '/pages/edit/{id}', 'PagesController@edit')->name('auth_pages_edit');
    
    // Forums
    Route::match(['get', 'post'], '/forum', 'ForumController@index')->name('auth_forum');
    
    // Members
    Route::match(['get', 'post'], '/forum/members', 'MembersController@index')->name('auth_members');
    Route::match(['get', 'post'], '/forum/members/create', 'MembersController@create')->name('auth_members_create');
    Route::match(['get', 'post'], '/forum/members/edit/{id}', 'MembersController@edit')->name('auth_members_edit');
    Route::match(['get', 'post'], '/forum/members/search', 'MembersController@search')->name('auth_members_search');
    Route::get('/forum//members/remove/{id}', 'MembersController@remove')->name('auth_members_remove');
    
    // Groups
    Route::match(['get', 'post'], '/forum/groups', 'GroupsController@index')->name('auth_groups');
    
    // Comments
    Route::match(['get', 'post'], '/forum/comments', 'CommentsController@index')->name('auth_comments');
    
    // Threads
    $this->get('/forum/threads', 'ThreadsController@index')->name('auth_threads');
    Route::match(['get', 'post'], '/forum/threads/create', 'ThreadsController@create')->name('auth_threads_create');
    Route::match(['get', 'post'], '/forum/threads/edit/{id}', 'ThreadsController@edit')->name('auth_threads_edit');
    Route::match(['get', 'post'], '/forum/threads/search', 'ThreadsController@search')->name('auth_threads_search');
    Route::match(['get', 'post'], '/forum/threads/remove/{id?}', 'ThreadsController@remove')->name('auth_threads_remove');
    
    
    
    // Registration Routes...
//     $this->get('/register', 'RegisterController@showRegistrationForm')->name('register');
//     $this->post('/register', 'RegisterController@register');
    
    // Password Reset Routes...
//     $this->get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//     $this->post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     $this->get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//     $this->post('/password/reset', 'ResetPasswordController@reset');
    
});

Route::group(['prefix' => ''], function () {
    
    $config = Config::first();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/gioi-thieu' . $config['url_ext'], 'HomeController@about')->name('about');
    Route::get('/delivery' . $config['url_ext'], 'HomeController@delivery')->name('delivery');
    Route::match(['get', 'post'], '/products' . $config['url_ext'], 'HomeController@products')->name('products');
    Route::get('/cart' . $config['url_ext'], 'CartController@index')->name('cart');
    Route::match(['get', 'post'], '/lien-he' . $config['url_ext'], 'HomeController@contact')->name('contact');
    Route::post('/search' . $config['url_ext'], 'HomeController@search')->name('search');
    Route::match(['get', 'post'], '/login' . $config['url_ext'], 'MembersController@index')->name('member_login');
    Route::post('/register' . $config['url_ext'], 'MembersController@register')->name('register');
    Route::get('/logout' . $config['url_ext'], 'MembersController@logout')->name('member_logout');
    
    Route::post('/load-data' . $config['url_ext'], 'HomeController@loadData')->name('loadData');
    
    Route::get('/vendor/{vendor}' . $config['url_ext'], 'HomeController@vendor')->name('vendor');
    Route::get('/danh-muc/{slug}' . $config['url_ext'], 'HomeController@category')->name('category');
    Route::get('/tin-tuc/{slug}' . $config['url_ext'], 'HomeController@postGroup')->name('post_groups');
    Route::get('/tin-tuc/{slug}/{slug1}' . $config['url_ext'], 'HomeController@posts')->name('posts');
    Route::get('/{slug}' . $config['url_ext'], 'HomeController@productDetails')->name('product_details');
    Route::get('refreshcaptcha', 'MembersController@refreshCaptcha')->name('refreshcaptcha');
    Route::post('checkcaptcha', 'MembersController@checkCaptcha')->name('checkCaptcha');
    
    Route::get('/offline' . $config['url_ext'], function() {
        echo 'System is offline. Please wait...';
        exit;
    })->name('offline');
});




