<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
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
    return view('register');
});
Route::post('save', [RegisterController::class, 'save'])->name('save');
Route::post('check', [LoginController::class, 'check'])->name('check');
Route::get('logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('login', [LoginController::class, 'login'])->name('login');
    //Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::get('editUser{user_id}', [UsersController::class, 'editUser']);
    Route::get('deleteUser{user_id}', [UsersController::class, 'deleteUser']);
    Route::put('updateUser{user_id}', [UsersController::class, 'updateUser']);
});
