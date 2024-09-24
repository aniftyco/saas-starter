<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ConfirmPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
use App\Http\Resources\SessionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => match (auth()->check()) {
    // Show dashboard to authenticated users
    true => inertia('dashboard'),
    // Show marketing page to unauthenticated users
    false => view('marketing.index'),
})->name('home');

// All routes accessible by unauthenticated users
Route::middleware('guest')->group(function (): void {
    Route::get('/sign-in', [SignInController::class, 'show'])->name('sign-in');
    Route::post('/sign-in', [SignInController::class, 'create']);

    Route::get('/sign-up', [SignUpController::class, 'show'])->name('sign-up');
    Route::post('/sign-up', [SignUpController::class, 'create']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.forgot');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.email');

    Route::get('/reset-password/{reset:token}', [ResetPasswordController::class, 'show'])
        ->name('password.reset')
        ->missing(fn() => redirect()->route('password.forgot'));
    Route::post('/reset-password/{reset:token}', [ResetPasswordController::class, 'update'])->name('password.update');
});

// All routes accessible by authenticated users
Route::middleware(['auth', 'auth.session'])->group(function (): void {
    Route::post('/sign-out', SignOutController::class)->name('sign-out');

    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::put('/account/password', [PasswordController::class, 'update'])->name('password.change');

    Route::get('/confirm-password', [ConfirmPasswordController::class, 'index'])->name('password.confirm.screen');
    Route::get('/account/confirm-password', [ConfirmPasswordController::class, 'show'])->name('password.confirm.status');
    Route::post('/account/confirm-password', [ConfirmPasswordController::class, 'store'])->name('password.confirm');

    Route::delete('/account/sessions', [SessionsController::class, 'destroy'])->name('sessions.destroy');

    Route::get('/banner', function () {
        session()->flash('flash', [
            'banner' => [
                'message' => 'This is a banner message!',
                'variant' => 'danger',
            ]
        ]);

        return redirect()->route('home');
    })->name('banner');
});
