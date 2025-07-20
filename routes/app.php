<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'dashboard')->name('app.dashboard');
});
