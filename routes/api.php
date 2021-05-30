<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('getmembers', 'App\Http\Controllers\ApiController@getmembers');
Route::post('addmember', 'App\Http\Controllers\ApiController@addmember');
Route::post('editmember', 'App\Http\Controllers\ApiController@editmember');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
