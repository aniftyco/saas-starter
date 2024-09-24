<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        auth()->logout();

        $request->session()->regenerate(true);
        $request->session()->regenerateToken();

        return inertia()->location(url('/'));
    }
}
