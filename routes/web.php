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


//Route::get('/','HomeController@index')->middleware('auth.shop')->name('home');
Route::post('/webhook/orders-create','WebhookController@OrdersCreate');
Route::post('/webhook/app-uninstalled','WebhookController@AppUninstalled');

Route::get('/orders','OrderController@index')->name('orders');


//Dashboard
Route::get('/','HomeController@dashboard')->middleware('auth.shop')->name('home');
Route::get('/settings','HomeController@getSettings')->middleware('auth.shop')->name('get_setting');
Route::post('/','HomeController@saveSetting')->middleware('auth.shop')->name('save_setting');

Route::get('/script/recently','HomeController@script')->name('script');
Route::get('/recently/style.css','HomeController@style')->name('style');
Route::any('/store','HomeController@store')->name('store')->middleware('cors');


//stats
Route::get('/stats','StatController@index')->middleware('auth.shop')->name('stats');
Route::get('/stats-count','StatController@count')->middleware('auth.shop')->name('stats_count');
Route::post('/stats','StatController@save')->middleware('cors')->name('save_stats');
Route::get('/analytics','StatController@analytics')->middleware('auth.shop')->name('analytics');