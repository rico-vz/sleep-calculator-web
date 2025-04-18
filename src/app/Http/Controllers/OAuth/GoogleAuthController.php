<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Google.');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser);
            return redirect('/dashboard')->with('success', 'Logged in successfully.');
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
                'requires_password_setup' => true,
            ]);

            event(new Registered($newUser));

            Auth::login($newUser);
            return redirect()->route('password.setup')->with('success', 'Please set a password for your new account.');
        }
    }
}
