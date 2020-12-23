<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/reports', 'ReportModelsController@index')->name('reportsIndex');
Route::get('/orders', 'OrdersController@index')->name('ordersIndex');
Route::get('/mouldings', 'MouldingsController@index')->name('mouldingsIndex');
Route::get('/vendors', 'VendorsController@index')->name('vendorsIndex');
Route::get('/mats', 'MatModelsController@index')->name('matsIndex');
Route::get('/glasses', 'GlassesController@index')->name('glassesIndex');
Route::get('/foamcores', 'FoamcoresController@index')->name('foamcoresIndex');

Route::get('/reports/view/{id}', 'ReportModelsController@view');
Route::get('/orders/view/{id}', 'OrdersController@view');
Route::get('/vendors/view/{id}', 'VendorsController@view');
Route::get('/mouldings/view/{id}', 'MouldingsController@view');
Route::get('/mats/view/{id}', 'MatModelsController@view');
Route::get('/glasses/view/{id}', 'GlassesController@view');
Route::get('/foamcores/view/{id}', 'FoamcoresController@view');

Route::get('/reports/list', 'ReportModelsController@list');
Route::get('/orders/list', 'OrdersController@list');
Route::get('/mouldings/list', 'MouldingsController@list');
Route::get('/vendors/list', 'VendorsController@list');
Route::get('/mats/list', 'MatModelsController@list');
Route::get('/glasses/list', 'GlassesController@list');
Route::get('/foamcores/list', 'FoamcoresController@list');

Route::post('/reports', 'ReportModelsController@store');
Route::post('/orders', 'OrdersController@store');
Route::post('/mouldings', 'MouldingsController@store');
Route::post('/vendors', 'VendorsController@store');
Route::post('/mats', 'MatModelsController@store');
Route::post('/glasses', 'GlassesController@store');
Route::post('/foamcores', 'FoamcoresController@store');

Route::get('/reports/create', 'ReportModelsController@create')->name('reportsCreate');
Route::get('/orders/create', 'OrdersController@create')->name('ordersCreate');
Route::get('/mouldings/create', 'MouldingsController@create')->name('mouldingsCreate');
Route::get('/vendors/create', 'VendorsController@create')->name('vendorsCreate');
Route::get('/mats/create', 'MatModelsController@create')->name('matsCreate');
Route::get('/glasses/create', 'GlassesController@create')->name('glassesCreate');
Route::get('/foamcores/create', 'FoamcoresController@create')->name('foamcoresCreate');

Route::get('/reports/edit/{id}', 'ReportModelsController@edit');
Route::get('/orders/edit/{id}', 'OrdersController@edit');
Route::get('/mouldings/edit/{id}', 'MouldingsController@edit');
Route::get('/vendors/edit/{id}', 'VendorsController@edit');
Route::get('/mats/edit/{id}', 'MatModelsController@edit');
Route::get('/glasses/edit/{id}', 'GlassesController@edit');
Route::get('/foamcores/edit/{id}', 'FoamcoresController@edit');

Route::patch('/reports/edit/{id}', 'ReportModelsController@update');
Route::patch('/orders/edit/{id}', 'OrdersController@update');
Route::patch('/mouldings/edit/{id}', 'MouldingsController@update');
Route::patch('/vendors/edit/{id}', 'VendorsController@update');
Route::patch('/mats/edit/{id}', 'MatModelsController@update');
Route::patch('/glasses/edit/{id}', 'GlassesController@update');
Route::patch('/foamcores/edit/{id}', 'FoamcoresController@update');

Route::delete('/orders/delete/{id}', 'OrdersController@destroy');
Route::delete('/mouldings/delete/{id}', 'MouldingsController@destroy');
Route::delete('/vendors/delete/{id}', 'VendorsController@destroy');
Route::delete('/mats/delete/{id}', 'MatModelsController@destroy');
Route::delete('/glasses/delete/{id}', 'GlassesController@destroy');
Route::delete('/foamcores/delete/{id}', 'FoamcoresController@destroy');

Route::get('/reports/add', 'ReportModelsController@addOrder');
Route::get('/reports/load', 'ReportModelsController@loadOrder');
Route::get('/reports/verify', 'ReportModelsController@verifyDateRangeContainsOrder');
Route::get('/reports/daterangeorders', 'ReportModelsController@dateRangeOrdersInReport');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
