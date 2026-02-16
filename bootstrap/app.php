<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            base_path('routes/web.php'),
        ],
        commands: base_path('routes/console.php'),
        health: '/healthz',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => route('sign-in'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
