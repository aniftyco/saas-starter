<?php

use App\Models\User;
use App\Notifications\Example;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.index')->name('index');
Route::get('/email', function () {
    return new Example()->toMail(User::first());
});
