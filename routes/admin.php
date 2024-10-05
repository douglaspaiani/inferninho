<?php

use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/auth', [\App\Http\Controllers\AdminController::class, 'Login'])->name('admin.login');
Route::post('/auth', [\App\Http\Controllers\AdminController::class, 'LoginPost'])->name('admin.login');
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'Dashboard'])->name('admin.dashboard');
    // Creators
    Route::get('/creators', [\App\Http\Controllers\AdminController::class, 'Creators'])->name('admin.creators');
    Route::get('/edit-creator/{id}', [\App\Http\Controllers\AdminController::class, 'EditCreator'])->name('admin.edit-creator');
    Route::post('/edit-creator/{id}', [\App\Http\Controllers\AdminController::class, 'EditCreatorPost'])->name('admin.edit-creator');
    // Ban
    Route::get('/banned', [\App\Http\Controllers\AdminController::class, 'Banned'])->name('admin.banned');
    Route::get('/ban/{id}', [\App\Http\Controllers\AdminController::class, 'BanUser'])->name('admin.ban');
    Route::get('/unban/{id}', [\App\Http\Controllers\AdminController::class, 'UnbanUserConfirm'])->name('admin.unban-confirm');
    Route::get('/unban-confirm/{id}', [\App\Http\Controllers\AdminController::class, 'UnbanUser'])->name('admin.unban');
    Route::get('/ban-confirm/{id}', [\App\Http\Controllers\AdminController::class, 'BanUserConfirm'])->name('admin.confirm-ban');
    // Subscribers
    Route::get('/subscribers', [\App\Http\Controllers\AdminController::class, 'Subscribers'])->name('admin.subscribers');
    Route::get('/edit-subscriber/{id}', [\App\Http\Controllers\AdminController::class, 'EditSubscriber'])->name('admin.edit-subscriber');
    Route::post('/edit-subscriber/{id}', [\App\Http\Controllers\AdminController::class, 'EditSubscriberPost'])->name('admin.edit-subscriber');
    // Support
    Route::get('/support', [\App\Http\Controllers\AdminController::class, 'SupportPage'])->name('admin.support');
    Route::get('/support-closed', [\App\Http\Controllers\AdminController::class, 'SupportClosedPage'])->name('admin.support-closed');
    Route::get('/support/{id}', [\App\Http\Controllers\AdminController::class, 'ReadSupport'])->name('admin.read-support');
    Route::post('/support/{id}', [\App\Http\Controllers\AdminController::class, 'AddResponseSupport'])->name('admin.read-support');
    Route::get('/close-support/{id}', [\App\Http\Controllers\AdminController::class, 'CloseSupport'])->name('admin.close-support');
    // Logout
    Route::get('/logout', [\App\Http\Controllers\AdminController::class, 'Logout'])->name('admin.logout');
});