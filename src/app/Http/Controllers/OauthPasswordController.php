<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class OauthPasswordController extends Controller
{
    public function showSetup()
    {
        return Inertia::render('auth/SetupPassword');
    }

    public function storeSetup(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($validated['password']);
        $user->requires_password_setup = false;
        $user->save();

        return redirect('/dashboard')->with('success', 'Password set successfully.');
    }
}
