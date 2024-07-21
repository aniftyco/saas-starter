<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('app', fn () => inertia('Welcome', ['name' => 'World']));
