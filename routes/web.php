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
Route::match(['get','post'],'/web/{type}','WebController@functionType');
Route::match(['get','post'],'/bus/{type}','BusController@functionType');

Route::match(['get','post'],'/web/test','WebController@test');