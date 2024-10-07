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
    // Ambil data dari callback
    $telegramUserData = $request->all();

    // Jika ada data dari Telegram
    if (isset($telegramUserData['id'])) {
        // Cari pengguna di database berdasarkan Telegram ID
        $user = User::where('telegram_id', $telegramUserData['id'])->first();

        if (!$user) {
            // Jika user tidak ditemukan, arahkan untuk mendaftar
            return response()->json([
                'message' => 'Pengguna belum terdaftar. Silakan mendaftar terlebih dahulu.',
                'register_link' => url('/register') // Link ke halaman pendaftaran jika belum terdaftar
            ]);
        }

        // Buat sesi login Laravel
        Auth::login($user);

        // Berikan pesan konfirmasi
        return response()->json([
            'message' => 'Hai ' . $user->name . ', Apakah ini akun Anda?',
            'confirmation_link' => url('/auth/telegram/confirm-login/' . $user->id),
        ]);
    }

    return response()->json(['message' => 'Tidak ada data dari Telegram.']);
}

public function confirmLogin($id)
{
    // Cari pengguna berdasarkan ID yang diterima
    $user = User::find($id);

    if (!$user) {
        return redirect('/login')->with('error', 'Pengguna tidak ditemukan.');
    }

    // Login pengguna di Laravel
    Auth::login($user);

    // Redirect ke dashboard
    return redirect('/dashboard')->with('success', 'Anda telah berhasil login menggunakan Telegram.');
}


    private function isValidTelegramData($data)
    {
        // Implementasikan validasi token dan data Telegram
        // Pastikan data yang diterima dari Telegram valid dan sah
        // Biasanya Anda perlu memverifikasi token yang dikirim oleh Telegram
        return true;
    }
}

