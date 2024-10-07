<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // Pastikan ini ada
use Illuminate\Support\Facades\Hash;  // Pastikan ini ada

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan role admin jika belum ada
        DB::table('roles')->updateOrInsert(
            ['name' => 'admin'],
            ['description' => 'Administrator']
        );

        // Tambah role lainnya jika diperlukan
        DB::table('roles')->updateOrInsert(
            ['name' => 'user'],
            ['description' => 'Regular User']
        );
    }
}
