<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        if (!in_array($provider, ['google', 'twitter', 'facebook'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        if (!in_array($provider, ['google', 'twitter', 'facebook'])) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if (!$user && $socialUser->getEmail()) {
                $user = User::where(
                    'email',
                    $socialUser->getEmail()
                )->first();
            }

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName()
                        ?: $socialUser->getNickname()
                        ?: 'User',

                    'email' => $socialUser->getEmail()
                        ?: $socialUser->getId() . '@' . $provider . '.local',

                    'password' => bcrypt(Str::random(24)),

                    'role' => 'staff',

                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }

            Auth::login($user);

            return redirect()
                ->route('home')
                ->with(
                    'success',
                    'Login berhasil menggunakan ' . ucfirst($provider)
                );

        } catch (\Exception $e) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Login menggunakan ' . ucfirst($provider) . ' gagal.'
                );
        }
    }
}