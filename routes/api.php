<?php

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


Route::get('/warteg',[\App\Http\Controllers\Api\WartegApiController::class, 'index']);
Route::post('/warteg/create',[\App\Http\Controllers\Api\WartegApiController::class, 'create']);
Route::get('/warteg/{id}',[\App\Http\Controllers\Api\WartegApiController::class, 'show']);
Route::middleware('jwt.verify')->post('/warteg/{id}/update',[\App\Http\Controllers\Api\Owner\WartegOwnerApiController::class, 'update']);


Route::get('/menu',[\App\Http\Controllers\Api\MenuApiController::class, 'index']);
Route::get('/menu/{id}',[MenuAp\App\Http\Controllers\Api\MenuApiControlleriController::class, 'show']);
Route::middleware('jwt.verify')->post('/menu/create',[\App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController::class, 'create']);
Route::middleware('jwt.verify')->post('/menu/{id}/update',[\App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController::class, 'update']);
Route::middleware('jwt.verify')->post('/menu/{id}/delete',[\App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController::class, 'delete']);

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'index']);
    Route::post('logout', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'logout']);
    Route::get('me', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'me']);
    Route::post('/', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'index']);

});
