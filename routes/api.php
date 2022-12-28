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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [\App\Http\Controllers\AuthController::class,'viewOnly'])->middleware('auth:sanctum');

Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'createUser']);
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'loginUser']);
 */
//Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');


Route::group(['prefix' => 'v1/',  'namespace' => '\App\Http\Controllers'], function () {
    Route::resource('user', UserController::class);
});