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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('apiv1/restosnear', 'ApiController@restosnear');
Route::get('apiv1/reviews/{restoid}', 'ApiController@restoreviews');

Route::post('apiv1/review', 'ApiController@addreview');
Route::post('apiv1/addresto', 'ApiController@addresto');