<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChangelogController;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/privacy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('privacy');

Route::get('/terms', function () {
    return Inertia::render('TermsOfService');
})->name('terms');

Route::get('/faq', function () {
    return Inertia::render('FAQ');
})->name('faq');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{post}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::get('/changelog', [ChangelogController::class, 'show'])
    ->name('changelog.show');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::passkeys();

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/socialite.php';
