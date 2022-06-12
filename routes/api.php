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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/book')->group(function () {

    Route::get('/', ['uses' => 'App\Http\Controllers\BookController@getAll']);
    Route::get('/{id}', ['uses' => 'App\Http\Controllers\BookController@get']);
    Route::post('/', ['uses' => 'App\Http\Controllers\BookController@create']);
    Route::delete('/{id}', ['uses' => 'App\Http\Controllers\BookController@delete']);
    Route::put('/{id}', ['uses' => 'App\Http\Controllers\BookController@edit']);

});

Route::prefix('/bookStatuses')->group(function () {

    Route::get('/', ['uses' => 'App\Http\Controllers\BookStatusController@getAll']);
    Route::get('/{id}', ['uses' => 'App\Http\Controllers\BookStatusController@get']);

});
