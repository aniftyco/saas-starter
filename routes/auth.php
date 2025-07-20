<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->name('auth.')->group(function () {
    Route::inertia('sign-in', 'auth/sign-in')->name('sign-in');
});
