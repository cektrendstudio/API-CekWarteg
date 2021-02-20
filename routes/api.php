<?php

use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\Owner\AuthOwnerApiController;
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


Route::get('/menu',[MenuApiController::class, 'index']);
Route::get('/menu/{id}',[MenuApiController::class, 'show']);

Route::group([


    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthOwnerApiController::class, 'login']);
    Route::post('logout', [AuthOwnerApiController::class, 'logout']);
    Route::get('me', [AuthOwnerApiController::class, 'me']);
    Route::get('/', [AuthOwnerApiController::class, 'index']);

});
