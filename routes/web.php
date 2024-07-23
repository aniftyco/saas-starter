<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.index');

Route::get('app', fn () => inertia('Welcome', ['name' => 'World']));
