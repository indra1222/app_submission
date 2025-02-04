<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin jika belum ada
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'account_limit' => null,
                'accounts_created' => 0,
            ]);
        }

        // Array untuk menyimpan user yang akan dibuat
        $users = [
            [
                'name' => 'User One',
                'email' => 'user1@example.com',
                'password' => 'password1'
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@example.com',
                'password' => 'password2'
            ],
            [
                'name' => 'User Three',
                'email' => 'user3@example.com',
                'password' => 'password3'
            ],
            [
                'name' => 'User Four',
                'email' => 'user4@example.com',
                'password' => 'password4'
            ],
            [
                'name' => 'User Five',
                'email' => 'user5@example.com',
                'password' => 'password5'
            ],
            [
                'name' => 'User Six',
                'email' => 'user6@example.com',
                'password' => 'password6'
            ],
            [
                'name' => 'User Seven',
                'email' => 'user7@example.com',
                'password' => 'password7'
            ],
        ];

        // Buat user baru hanya jika belum ada
        foreach ($users as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => 'user',
                    'account_limit' => 7,
                    'accounts_created' => 0,
                ]);
            }
        }
    }
}