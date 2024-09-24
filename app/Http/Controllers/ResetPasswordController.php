<?php

namespace App\Http\Controllers;

use App\Events\PasswordReset as PasswordResetEvent;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    public function show(Request $request, PasswordReset $reset): RedirectResponse|\Inertia\Response
    {
        if (!$request->hasValidSignature()) {
            return inertia()->location(route('password.forgot'));
        }

        return inertia('reset-password', $reset);
    }

    public function update(Request $request, PasswordReset $reset): Response
    {
        $user = User::whereEmail($request->get('email'))->first();

        if (!$user) {
            return inertia()->location(route('password.forgot'));
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        $reset->delete();

        event(new PasswordResetEvent($user));

        return inertia()->location(route('sign-in'));
    }
}
