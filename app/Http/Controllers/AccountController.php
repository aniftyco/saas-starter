<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Inertia\Response;

class AccountController extends Controller
{
    public function index(): Response
    {
        return inertia('account', [
            'sessions' => SessionResource::collection(auth()->user()->sessions()->latest()->get()),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $confirmed = auth()->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ]);

        if (!$confirmed) {
            throw ValidationException::withMessages([
                'password' => ['The provided password does not match our records.'],
            ]);
        }

        $request->user()->delete();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return inertia()->location(route('home'));
    }
}
