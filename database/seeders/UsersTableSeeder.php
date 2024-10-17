<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Hash;  

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan pengguna admin
        DB::table('users')->updateOrInsert(
            ['email' => 'rahelfitrianata@gmail.com'],
            [
                'name' => 'Rahel Fitrianata',
                'password' => Hash::make('admin123'), // Sesuaikan password dengan yang Anda inginkan
                'role_id' => 1 // Pastikan role_id 1 sesuai dengan ID role admin di tabel roles
            ]
        );
    }
}