<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home/user', [App\Http\Controllers\UserController::class,'index'])->name('user.index');
Route::get('/home/user/create', [App\Http\Controllers\UserController::class,'create'])->name('user.create');
Route::get('/home/user/{id}', [App\Http\Controllers\UserController::class,'edit'])->name('user.edit');
Route::delete('/home/user/{id}/delete', [App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy');
Route::post('/home/user/create', [App\Http\Controllers\UserController::class,'store'])->name('user.store');
Route::put('/home/user/${id}/update', [App\Http\Controllers\UserController::class,'update'])->name('user.update');
