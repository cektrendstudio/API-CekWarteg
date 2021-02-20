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

Route::group(['prefix' => 'warteg'], function ($router) {
    Route::get('', [\App\Http\Controllers\Api\WartegApiController::class, 'index']);
    Route::post('/create', [\App\Http\Controllers\Api\WartegApiController::class, 'create']);
    Route::get('/{id}', [\App\Http\Controllers\Api\WartegApiController::class, 'show']);
    Route::middleware('jwt.verify')->post('/{id}/update', [\App\Http\Controllers\Api\Owner\WartegOwnerApiController::class, 'update']);
});


Route::group(['prefix' => 'menu'], function ($router) {
    Route::get('warteg/{id}', [\App\Http\Controllers\Api\MenuApiController::class,'menuByWarteg']);
    Route::post('/{id}/review', [\App\Http\Controllers\Api\MenuApiController::class,'createReview']);
    Route::get('', [\App\Http\Controllers\Api\MenuApiController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Api\MenuApiController::class, 'show']);
    Route::middleware('jwt.verify')->post('/create', [\App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController::class, 'create']);
    Route::middleware('jwt.verify')->post('{id}/update', [\App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController::class, 'update']);
    Route::middleware('jwt.verify')->post('/{id}/delete', [\App\Http\Controllers\Api\Owner\MenuWartegOwnerApiController::class, 'delete']);

});
Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'index']);
    Route::post('logout', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'logout']);
    Route::get('me', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'me']);
    Route::post('/', [\App\Http\Controllers\Api\Owner\AuthOwnerApiController::class, 'index']);

});
