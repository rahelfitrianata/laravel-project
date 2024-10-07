<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\PollTelegramUpdates;

class ScheduleController extends Controller
{
    // Menampilkan halaman jadwal
    public function index()
    {
        // Ambil daftar task terjadwal, contoh di sini masih statis
        $tasks = [
            [
                'name' => 'Poll Telegram Updates',
                'description' => 'Fetch updates from Telegram every minute',
                'schedule' => '* * * * *', // Setiap menit
            ],
            // Anda bisa menambahkan lebih banyak tasks di sini
        ];

        return view('schedule.index', compact('tasks'));
    }

    // Tambahkan task baru ke jadwal
    public function add(Request $request)
    {
        // Tambahkan logika di sini untuk menambahkan task baru
        // Misalnya: Artisan::call('schedule:run'); atau queueing job
        Artisan::call('schedule:run'); // Menjalankan task secara manual

        return redirect()->route('schedule.index');
    }
}
