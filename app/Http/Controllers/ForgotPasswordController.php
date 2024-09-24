<?php

namespace App\Http\Controllers;

use App\Events\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\PasswordReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    public function show(): \Inertia\Response
    {
        return inertia('forgot-password');
    }

    public function create(ForgotPasswordRequest $request): Response
    {
        PasswordReset::where('email', $request->get('email'))->delete();

        $reset = PasswordReset::create([
            'email' => $request->get('email'),
            'token' => str()->random(40),
            'created_at' => now(),
        ]);

        $url = URL::signedRoute('password.reset', $reset);

        event(new ResetPasswordRequest($reset->email, $url));

        return inertia()->location(route('sign-in'));
    }
}
