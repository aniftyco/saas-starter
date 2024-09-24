<?php

namespace App\Http\Controllers;

use App\Events\UserSignedIn;
use App\Http\Requests\SignInRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class SignInController extends Controller
{
    public function show(): Response
    {
        return inertia('sign-in');
    }

    public function create(SignInRequest $request): RedirectResponse
    {
        if (auth()->attempt($request->only('email', 'password'), $request->get('remember', false))) {
            $user = auth()->user();

            event(new UserSignedIn($user));

            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
