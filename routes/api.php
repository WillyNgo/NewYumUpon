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

Route::get('apiv1/getrestosnear/', 'ApiController@getRestosNear');
Route::get('apiv1/getrestoreviews/', 'ApiController@getRestoReviews');

Route::post('apiv1/addreview', 'ApiController@addreview');
Route::post('apiv1/addresto', 'ApiController@addresto');