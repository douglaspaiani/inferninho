<?php

use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/auth', [\App\Http\Controllers\AdminController::class, 'Login'])->name('admin.login');
Route::post('/auth', [\App\Http\Controllers\AdminController::class, 'LoginPost'])->name('admin.login');
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'Dashboard'])->name('admin.dashboard');
});