<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::inertia('sign-in', 'auth/sign-in')->name('auth.sign-in');
});
