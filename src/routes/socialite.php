<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuth\GoogleAuthController;


Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('auth.google.callback');
