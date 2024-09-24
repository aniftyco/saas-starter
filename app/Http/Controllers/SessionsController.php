<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        $confirmed = auth()->validate([
            'email' => $request->user()->email,
            'password' => $request->password
        ]);

        if (!$confirmed) {
            throw ValidationException::withMessages([
                'password' => __('The password is incorrect.'),
            ]);
        }

        auth()->logoutOtherDevices($request->password);

        Session::where('user_id', $request->user()->getAuthIdentifier())
            ->where('id', '!=', $request->session()->getId())
            ->delete();

        return back(303);
    }
}
