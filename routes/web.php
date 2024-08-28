<?php

use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'LoginPage'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'Login'])->name('login');
// REGISTER
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'RegisterPage'])->name('register');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'Register'])->name('register');
// APP ROUTES
Route::middleware('auth')->prefix('app')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'Logout'])->name('logout');
    Route::get('/home', [\App\Http\Controllers\UserController::class, 'HomePage'])->name('home');
    Route::get('/following', [\App\Http\Controllers\UserController::class, 'FollowingPage'])->name('following');
    Route::get('/credit-cards', [\App\Http\Controllers\UserController::class, 'CreditCardsPage'])->name('credit-cards');
    Route::get('/add-credit-card', [\App\Http\Controllers\UserController::class, 'AddCreditCardPage'])->name('add-credit-card');
});

