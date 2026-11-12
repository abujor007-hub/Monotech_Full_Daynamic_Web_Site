<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{ // Redirect to Google Account Selection
    public function redirect()
    {
        return Socialite::driver('google')
            ->with([
                'prompt' => 'consent select_account'
            ])
            ->redirect();
    }

    // Google Callback
    public function callback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $email = $googleUser->getEmail();

            if (!$email || !($googleUser->user['verified_email'] ?? false)) {
                return redirect('/login')
                    ->withErrors([
                        'google' => 'Google email is not verified.'
                    ]);
            }

            // Find existing user
            $user = User::where('email', $email)->first();

            if ($user) {

                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);

            } else {

                $user = User::create([
                    'name' => $googleUser->getName() ?? 'Google User',
                    'email' => $email,
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(str()->random(24)),
                    'email_verified_at' => now(),
                ]);
            }

            // Login
            Auth::login($user);

            request()->session()->regenerate();

            // Redirect Dashboard
            return redirect()->intended('/dashboard');

        } catch (\Throwable $e) {

            report($e);

            return redirect('/login')
                ->withErrors([
                    'google' => 'Google login failed. Please try again.'
                ]);
        }
    }
}