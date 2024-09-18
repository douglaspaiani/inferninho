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
    // Globals
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'Logout'])->name('logout');
    Route::get('/home', [\App\Http\Controllers\UserController::class, 'HomePage'])->name('home');
    // Profile
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'ProfilePage'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\UserController::class, 'ProfilePost'])->name('profile');
    // Signature
    Route::get('/signature', [\App\Http\Controllers\UserController::class, 'SignaturePage'])->name('signature');
    Route::post('/signature', [\App\Http\Controllers\UserController::class, 'SignaturePost'])->name('signature');
    // Posting
    Route::post('/posts/{id}/like', [\App\Http\Controllers\PostController::class, 'Like'])->name('like');
    Route::get('/new-post', [\App\Http\Controllers\PostController::class, 'NewPostPage'])->name('newPost');
    Route::post('/new-post', [\App\Http\Controllers\PostController::class, 'NewPost'])->name('newPost');
    Route::get('/following', [\App\Http\Controllers\UserController::class, 'FollowingPage'])->name('following');
    // Credit cads
    Route::get('/credit-cards', [\App\Http\Controllers\UserController::class, 'CreditCardsPage'])->name('credit-cards');
    Route::get('/add-credit-card', [\App\Http\Controllers\UserController::class, 'AddCreditCardPage'])->name('add-credit-card');
});

// User Profile
Route::middleware('auth')->group(function () {
    Route::get('/{username}', [\App\Http\Controllers\UserController::class, 'UserProfilePage'])->name('username');
    Route::get('/{username}/subscribe', [\App\Http\Controllers\UserController::class, 'SubscribePage'])->name('subscribe');
    Route::post('/{username}/subscribe', [\App\Http\Controllers\UserController::class, 'SubscribePage'])->name('subscribe');
});    


