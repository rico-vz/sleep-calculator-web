<?php

use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Settings\SleepPreferencesController;
use App\Http\Controllers\Settings\PasskeyController;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('settings/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('settings/sleep-preferences', [SleepPreferencesController::class, 'edit'])
        ->name('sleep-preferences.edit');
    Route::patch('settings/sleep-preferences', [SleepPreferencesController::class, 'update'])
        ->name('sleep-preferences.update');

    Route::get('settings/passkeys', [PasskeyController::class, 'edit'])
        ->name('profile.passkeys.edit');
    Route::get('settings/passkeys/generate-options', [PasskeyController::class, 'generateOptions'])
        ->name('profile.passkeys.generate-options');
    Route::post('settings/passkeys', [PasskeyController::class, 'create'])
        ->name('profile.passkeys.create');
    Route::delete('settings/passkeys/{id}', [PasskeyController::class, 'destroy'])
        ->name('profile.passkeys.delete');

    Route::get('settings/appearance', function () {
        return Inertia::render('settings/Appearance');
    })->name('appearance');
});
