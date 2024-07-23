<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => match (auth()->check()) {
    // Show dashboard to authenticated users
    true => inertia('dashboard'),
    // Show landing page to unauthenticated users
    false => view('pages.index'),
})->name('home');

// All routes accessible by unauthenticated users
Route::middleware('guest')->group(function () {
    Route::inertia('/sign-in', 'sign-in')->name('sign-in');
    Route::post('/sign-in', SignInController::class);

    Route::inertia('/sign-up', 'sign-up')->name('sign-up');
    Route::post('/sign-up', SignUpController::class);

    Route::inertia('/forgot-password', 'forgot-password')->name('forgot-password');
    Route::post('/forgot-password', ForgotPasswordController::class);
});

// All routes accessible by authenticated users
Route::middleware('auth')->group(function () {
    Route::post('/sign-out', SignOutController::class)->name('sign-out');
});
