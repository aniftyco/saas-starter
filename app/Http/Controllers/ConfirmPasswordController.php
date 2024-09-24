<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConfirmPasswordController extends Controller
{
    public function index()
    {
        return inertia('confirm-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $confirmed = auth()->validate([
            'email' => auth()->user()->email,
            'password' => $request->password,
        ]);

        if (!$confirmed) {
            throw ValidationException::withMessages([
                'password' => ['The provided password does not match our records.'],
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', now()->unix());

        return redirect()->intended();
    }

    public function show(Request $request)
    {
        $lastConfirmation = $request->session()->get(
            'auth.password_confirmed_at',
            0
        );

        $lastConfirmed = now()->unix() - $lastConfirmation;

        $confirmed = $lastConfirmed < $request->input(
            'seconds',
            config('auth.password_timeout', 900)
        );

        return response()->json(['confirmed' => $confirmed], headers: array_filter([
            'X-Retry-After' => $confirmed ? $lastConfirmed : null
        ]));
    }
}
