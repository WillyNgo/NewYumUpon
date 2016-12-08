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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/search', 'SearchController@search');


Route::get('/detailResto/{restoid}', 'RestoController@showRestoDetails');
Route::get('/restos', 'RestoController@index')->middleware('auth');

Route::get('/addResto', 'RestoController@addResto')->middleware('auth');
Route::post('/resto', 'RestoController@store');

Route::get('/updateResto/{restoid}', 'RestoController@updateResto')->middleware('auth');
Route::put('/resto/{restoid}', 'RestoController@update');

Route::get('/reviews', 'ReviewController@index');
Route::post('/review', 'ReviewController@store');

Route::post('/geo','GeoController@index');