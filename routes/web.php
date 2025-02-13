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

Route::get('/', 'MainController@index')->name('index');
Route::get('/tradeflows/{filter}', 'MainController@tradeflows')->name('tradeflows');
Route::get('/containers/{filter}', 'MainController@containers')->name('containers');
Route::post('/import', 'MainController@import')->name('import');
