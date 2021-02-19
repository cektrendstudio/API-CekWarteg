<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/warteg',[WartegApiController::class, 'index']);
Route::post('/warteg/create',[WartegApiController::class, 'create']);
Route::get('/warteg/{id}',[WartegApiController::class, 'show']);
Route::post('/warteg/{id}/update',[WartegApiController::class, 'update']);
