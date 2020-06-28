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

Route::prefix('users')->group(function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\UserController@store');
    Route::post('refreshToken', 'API\AuthController@refreshToken');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'API\AuthController@logout');
        Route::post('details', 'API\UserController@show');
    });
});

Route::middleware('auth:api')->post('seats', 'API\SeatController@index');

Route::middleware('auth:api')->resource('reservation', 'API\ReservationController')->only('store');