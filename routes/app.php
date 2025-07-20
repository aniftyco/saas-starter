<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('app.')->group(function () {
    Route::inertia('/dashboard', 'dashboard')->name('dashboard');
});
