<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class PollTelegramUpdate extends Command
{
    protected $signature = 'poll:telegram-update';
    protected $description = 'Poll updates from Telegram';

    public function __construct()
    {
        parent::__construct();
    }  

    public function handle()
{
    $token = '7366110516:AAFpRJgWgju6PX-DYoDO8tLU_XVR4Txvl1o'; 
    $url = "https://api.telegram.org/bot{$token}/getUpdates";
    $lastUpdateId = 0;

    while (true) {
        $response = file_get_contents($url . "?offset=" . ($lastUpdateId + 1) . "&timeout=120");
        $updates = json_decode($response, true);

        if (!empty($updates['result'])) {
            foreach ($updates['result'] as $update) {
                $this->info('Received update: ' . json_encode($update));

                $lastUpdateId = $update['update_id'];

                if (isset($update['message']['entities'])) {
                    foreach ($update['message']['entities'] as $entity) {
                        if ($entity['type'] == 'bot_command') {
                            $command = substr($update['message']['text'], $entity['offset'], $entity['length']);

                            if ($command === '/start') {
                                $this->info('Start command received');

                                $chatId = $update['message']['chat']['id'];
                                $telegramId = $update['message']['from']['id'];
                                $telegramUsername = $update['message']['from']['username'] ?? null;

                                $user = User::where('telegram_id', $telegramId)->first();

                                if ($user) {
                                    
                                    $user->telegram_username = $telegramUsername;
                                    $user->save();

                                    $message = "Hai {$user->name}, apakah ini Anda?\nJika benar, silakan klik link berikut untuk login: [Klik Disini](https://7244-222-124-131-165.ngrok-free.app/auth/telegram/confirm-login/{$user->id})";
                                    $this->sendMessage($token, $chatId, $message, 'Markdown');
                                } else {
                                    $message = "Pengguna tidak ditemukan. Silakan mendaftar terlebih dahulu di [tautan ini](https://7244-222-124-131-165.ngrok-free.app/register)";
                                    $this->sendMessage($token, $chatId, $message, 'Markdown');
                                }
                            }
                        }
                    }
                }
            }
        }

        sleep(1);
    }
}


private function sendMessage($token, $chatId, $message, $parseMode = 'Markdown')
{
    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => $parseMode 
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($postData),
        ],
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        $this->error('Failed to send message');
    }
}
}