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
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('refreshtoken', 'AuthController@refreshToken');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('details', 'UserController@details');
    });
});