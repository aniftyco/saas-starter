<?php

namespace App\Http\Controllers;

use App\Events\UserSignedUp;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class SignUpController extends Controller
{
    public function show(): Response
    {
        return inertia('sign-up');
    }

    public function create(SignUpRequest $request): RedirectResponse
    {
        $user = User::create($request->only('name', 'email', 'password'));

        event(new UserSignedUp($user));

        auth()->login($user);

        return to_route('home');
    }
}
