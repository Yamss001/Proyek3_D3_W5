<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'budi'],
            [
                'id_user' => 'USR001',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => 'password123',
                'no_hp' => '081234567890',
                'alamat' => 'Bandung',
            ]
        );

        User::updateOrCreate(
            ['username' => 'dep'],
            [
                'id_user' => 'USR002',
                'nama_lengkap' => 'Deva Annurrahman',
                'email' => 'siti@example.com',
                'password' => 'dep12345',
                'no_hp' => '081234567891',
                'alamat' => 'Garut',
            ]
        );
    }
}