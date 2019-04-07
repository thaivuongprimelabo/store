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
Route::get('/load-city', 'ApiController@loadCity')->name('loadCity');
Route::get('/load-district', 'ApiController@loadDistrict')->name('loadDistrict');
Route::get('/load-ward', 'ApiController@loadWard')->name('loadWard');

