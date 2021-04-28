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
Route::prefix('auth')->group(function() {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::middleware(['auth:api'])->group(function() {
        Route::post('admin_only', 'App\Http\Controllers\AuthController@admin_only')->middleware('userscope:admin');
        Route::post('user_only', 'App\Http\Controllers\AuthController@user_only')->middleware('userscope:user');
        Route::post('logout',  'App\Http\Controllers\AuthController@logout');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
        Route::post('me', 'App\Http\Controllers\AuthController@me');
    });
  });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
