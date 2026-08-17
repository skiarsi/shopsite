<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    
    public function callback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Error on login with ' . ucfirst($provider) . '');
        }

        // create new user
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'email_verified_at' => now(),
                'password' => null, // null password
            ]
        );

        // if user don't have provider and provider_id
        if (! $user->provider_id) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }

        if ($socialUser->getAvatar()) {
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                ['avatar' => $socialUser->getAvatar()]
            );
        }

        Auth::login($user, remember: true);

        return redirect()->intended('/');
    }
}
