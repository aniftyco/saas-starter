<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::inertia('/welcome', 'welcome');
