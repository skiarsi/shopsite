<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;

Route::middleware(['guest'])->group(function(){
    // Route::get('/auth/google', [SocialController::class, 'redirect'])->name('auth.google');
    // Route::get('/api/auth/google/callback', [SocialController::class, 'callback']);

    Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');
});





Route::get('/', function () {
    return view('home');
})->name('home');
