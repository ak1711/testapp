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

Route::get('/', 'App\Http\Controllers\HomeController@member')->name('member');
Route::get('/{id}/edit', 'App\Http\Controllers\HomeController@edit');
Route::get('/{id}/delete', 'App\Http\Controllers\HomeController@delete')->name('memberdelete');
Route::post('/store', 'App\Http\Controllers\HomeController@memberstore')->name('memberstore');