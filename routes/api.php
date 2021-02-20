<?php

use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\Owner\AuthOwnerApiController;
use App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController;
use App\Http\Controllers\Api\WartegApiController;
use Illuminate\Http\Request;

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


Route::get('/warteg',[WartegApiController::class, 'index']);
Route::post('/warteg/create',[WartegApiController::class, 'create']);
Route::get('/warteg/{id}',[WartegApiController::class, 'show']);
Route::middleware('jwt.verify')->post('/warteg/{id}/update',[WartegApiController::class, 'update']);


Route::get('/menu',[MenuApiController::class, 'index']);
Route::get('/menu/{id}',[MenuApiController::class, 'show']);
Route::middleware('jwt.verify')->post('/menu/create',[MenuWartegOwnerApiController::class, 'create']);
Route::middleware('jwt.verify')->post('/menu/{id}/update',[MenuWartegOwnerApiController::class, 'update']);
Route::middleware('jwt.verify')->post('/menu/{id}/delete',[MenuWartegOwnerApiController::class, 'delete']);

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthOwnerApiController::class, 'index']);
    Route::post('logout', [AuthOwnerApiController::class, 'logout']);
    Route::get('me', [AuthOwnerApiController::class, 'me']);
    Route::post('/', [AuthOwnerApiController::class, 'index']);

});
