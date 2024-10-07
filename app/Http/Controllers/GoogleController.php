<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Login user yang sudah ada
                Auth::login($user);
            } else {
                // Jika user belum ada, buat user baru
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('password') // Password default atau random
                ]);

                Auth::login($newUser);
            }

            // Redirect ke dashboard setelah login berhasil
            return redirect()->intended('/dashboardumum');
        } catch (\Exception $e) {
            // Jika ada error, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['msg' => 'Login menggunakan Google gagal.']);
        }
    }
}

