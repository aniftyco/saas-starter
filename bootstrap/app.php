<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Inertia\EncryptHistoryMiddleware;
use Symfony\Component\HttpFoundation\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            base_path('routes/web.php'),
            base_path('routes/auth.php'),
            base_path('routes/app.php'),
        ],
        commands: base_path('routes/console.php'),
        health: '/healthz',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR
            | Request::HEADER_X_FORWARDED_PORT
            | Request::HEADER_X_FORWARDED_PROTO
        );

        $middleware->redirectGuestsTo(fn () => route('auth.sign-in'));

        $middleware->redirectUsersTo(fn () => route('app.dashboard'));

        $middleware->web(append: [
            HandleInertiaRequests::class,
            EncryptHistoryMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
