<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Buat akun user contoh
        User::create([
            'name' => 'User Test',
            'email' => 'user@user.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}