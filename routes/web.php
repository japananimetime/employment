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

Route::get('/', 'MainController@getCurrentWorkersPaginated');
Route::get('/filter', 'MainController@getCurrentWorkersByDepartmentPaginated');
Route::get('/search', 'MainController@searchCurrentWorkersPaginated');
Route::get('/employee/{id}', 'MainController@getSpecifiedEmployee');
Route::get('/statistics', 'MainController@statistics');
Route::get('/department/{id}', 'MainController@getDepartmentStatistics');
Route::get('/title/{id}', 'MainController@getCurrentWorkersByTitlePaginated');
