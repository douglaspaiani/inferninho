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
    Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'PostPage'])->name('post');
    Route::post('/post/{id}', [\App\Http\Controllers\CommentsController::class, 'PostComment'])->name('post');
    Route::post('/edit-comment/{id}', [\App\Http\Controllers\CommentsController::class, 'EditComment'])->name('edit-comment');
    Route::get('/delete-comment/{id}', [\App\Http\Controllers\CommentsController::class, 'DeleteComment'])->name('delete-comment');
    Route::post('/posts/{id}/like', [\App\Http\Controllers\PostController::class, 'Like'])->name('like');
    Route::get('/edit-post/{id}', [\App\Http\Controllers\PostController::class, 'EditPostPage'])->name('editPost');
    Route::post('/edit-post/{id}', [\App\Http\Controllers\PostController::class, 'EditPost'])->name('editPost');
    Route::get('/delete-post/{id}', [\App\Http\Controllers\PostController::class, 'DeletePost'])->name('deletePost');
    Route::get('/new-post', [\App\Http\Controllers\PostController::class, 'NewPostPage'])->name('newPost');
    Route::post('/new-post', [\App\Http\Controllers\PostController::class, 'NewPost'])->name('newPost');
    Route::get('/following', [\App\Http\Controllers\SubscriptionsController::class, 'FollowingPage'])->name('following');
    Route::get('/purchased', [\App\Http\Controllers\PhotosSoldController::class, 'PhotosPurchasedPage'])->name('purchased');
    // Credit cads
    Route::get('/credit-cards', [\App\Http\Controllers\CreditCardsController::class, 'CreditCardsPage'])->name('credit-cards');
    Route::get('/add-credit-card', [\App\Http\Controllers\CreditCardsController::class, 'AddCreditCardPage'])->name('add-credit-card');
    Route::post('/add-credit-card', [\App\Http\Controllers\CreditCardsController::class, 'AddCreditCardPost'])->name('add-credit-card');
    Route::post('/remove-credit-card/{id}', [\App\Http\Controllers\CreditCardsController::class, 'DeleteCreditCard'])->name('remove-credit-card');
    // Configurations
    Route::get('/configurations', [\App\Http\Controllers\UserController::class, 'ConfigurationsPage'])->name('configurations');
    Route::post('/configurations', [\App\Http\Controllers\UserController::class, 'ConfigurationsPost'])->name('configurations');
    // Search
    Route::get('/search/{search}', [\App\Http\Controllers\UserController::class, 'SearchPost'])->name('search');
    // Chat
    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'MessagesPage'])->name('messages');
    Route::get('/chat/{username}', [\App\Http\Controllers\ChatController::class, 'ChatPage'])->name('chat');
    Route::post('/chat/{username}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{username}/update', [\App\Http\Controllers\ChatController::class, 'Update'])->name('chat.update');
    // Support
    Route::get('/support', [\App\Http\Controllers\SupportController::class, 'SupportPage'])->name('support');
    Route::get('/open-support', [\App\Http\Controllers\SupportController::class, 'AddSupport'])->name('open-support');
    Route::post('/open-support', [\App\Http\Controllers\SupportController::class, 'AddSupportPost'])->name('open-support');
    Route::get('/support/{id}', [\App\Http\Controllers\SupportController::class, 'ReadSupport'])->name('read-support');
    Route::post('/support/{id}', [\App\Http\Controllers\SupportController::class, 'AddResponseSupport'])->name('read-support');
    Route::get('/close-support/{id}', [\App\Http\Controllers\ChatController::class, 'MessagesPage'])->name('close-support');
    // Payments
    Route::post('/{username}/payment-subscription', [\App\Http\Controllers\PaymentController::class, 'NewPaymentSubscription'])->name('payment-subscription');
    Route::post('/{username}/payment-photo/{id}', [\App\Http\Controllers\PaymentController::class, 'NewPaymentPhoto'])->name('payment-photo');
    Route::post('/{username}/payment-gift/{id}', [\App\Http\Controllers\PaymentController::class, 'NewPaymentGift'])->name('payment-gift');
    Route::get('/verify-payment/{type}/{id}', [\App\Http\Controllers\PaymentController::class, 'VerifyPayment'])->name('verify-payment');
    Route::get('/payment-photo/{id}', [\App\Http\Controllers\PaymentController::class, 'PaymentPhotoPage'])->name('payment-photo');
    Route::get('/payment-gift/{id}', [\App\Http\Controllers\PaymentController::class, 'PaymentGiftPage'])->name('payment-gift');
});

// User Profile
Route::get('/{username}', [\App\Http\Controllers\UserController::class, 'UserProfilePage'])->name('username');
Route::middleware('auth')->group(function () {
    Route::get('/{username}/grid', [\App\Http\Controllers\UserController::class, 'UserProfilePageGrid'])->name('username_grid');
    Route::get('/{username}/checkout', [\App\Http\Controllers\SubscriptionsController::class, 'CheckoutPage'])->name('checkout');
    Route::post('/{username}/checkout', [\App\Http\Controllers\SubscriptionsController::class, 'CheckoutPage'])->name('checkout');
});    


