<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function(){
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
    Route::get('/api/auth/google/callback', [GoogleController::class, 'callback']);
});


Route::get('/', function () {
    return view('home');
});
