<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/check_exists', 'ApiController@checkExists')->name('check_exists');
Route::post('/update_status', 'ApiController@updateStatus')->name('update_status');
Route::post('/sizes', 'ApiController@sizes')->name('sizes');
Route::post('/colors', 'ApiController@colors')->name('colors');
Route::post('/cart/add-item', 'ApiController@addItem')->name('cart.addItem');
Route::post('/cart/remove-item', 'ApiController@removeItem')->name('cart.removeItem');
Route::post('/cart/update-item', 'ApiController@updateItem')->name('cart.updateItem');
Route::post('/cart/check-out', 'ApiController@checkout')->name('cart.checkout');

