<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Jobs\PollTelegramUpdates;

class TelegramAuthController extends Controller
{
    public function handleTelegramCallback(Request $request)
{
    $telegramUserData = $request->all();

    if (isset($telegramUserData['id'])) {
        $user = User::where('telegram_id', $telegramUserData['id'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Pengguna belum terdaftar. Silakan mendaftar terlebih dahulu.',
                'register_link' => url('/register') 
            ]);
        }

        Auth::login($user);

        return response()->json([
            'message' => 'Hai ' . $user->name . ', Apakah ini akun Anda?',
            'confirmation_link' => url('/auth/telegram/confirm-login/' . $user->id),
        ]);
    }

    return response()->json(['message' => 'Tidak ada data dari Telegram.']);
}

public function confirmLogin($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect('/login')->with('error', 'Pengguna tidak ditemukan.');
    }

    Auth::login($user);

    return redirect('/dashboardumum')->with('success', 'Anda telah berhasil login menggunakan Telegram.');
}


    private function isValidTelegramData($data)
    {
        return true;
    }
}

