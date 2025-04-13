<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login/proses', 'login')->name('login.proses');
    Route::post('/logout', 'logout')->name('logout');
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    route::get('sipkar',[DashboardController::class,'index'])->name('admin.index');
    route::get('user Table',[UserController::class,'index'])->name('admin.userTable');
    route::get('user form add',[UserController::class,'create'])->name('admin.userAdd');
   });