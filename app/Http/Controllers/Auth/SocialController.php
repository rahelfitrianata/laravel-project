<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['redirectToProvider', 'handleProviderCallback']);
    }
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();

            $existingUser = User::where('email', $user->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'provider_id' => $user->getId(),
                    'provider' => $provider,
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended('dashboardumum');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login, silakan coba lagi.');
        }
    }

}

