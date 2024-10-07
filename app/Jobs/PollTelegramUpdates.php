<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PollTelegramUpdates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $response = Http::get("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/getUpdates");

        // Jika respons sukses
        if ($response->successful()) {
            $updates = $response->json();

            // Log update dari Telegram
            Log::info('Updates from Telegram: ' . json_encode($updates));

            foreach ($updates['result'] as $update) {
                if (isset($update['message']['text']) && $update['message']['text'] === '/start') {
                    // Ambil chat_id untuk merespons pengguna
                    $chatId = $update['message']['chat']['id'];

                    // Cek apakah user sudah ada berdasarkan telegram_id
                    $user = User::where('telegram_id', $chatId)->first();

                    if (!$user) {
                        // Buat user jika belum ada
                        $user = User::create([
                            'telegram_id' => $chatId,
                            'name' => $update['message']['chat']['first_name'],
                            'email' => $chatId . '@telegram.com', // Email dummy
                            'password' => bcrypt('password') // Password default
                        ]);
                    }

                    // Login user secara otomatis
                    Auth::login($user);

                    // Kirim pesan selamat datang
                    Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                        'chat_id' => $chatId,
                        'text' => 'Selamat datang, Anda berhasil login!'
                    ]);
                }
            }
        } else {
            Log::error('Failed to get updates from Telegram');
        }
    }
}
