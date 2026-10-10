<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username'     => 'dep',
                'nama_lengkap' => 'Deva Annurrahman',
                'password'     => 'deva123',
            ],
            [
                'username'     => 'budi',
                'nama_lengkap' => 'Budi Santoso',
                'password'     => 'budi12345',
            ]
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['username' => $data['username']],
                [
                    'nama_lengkap' => $data['nama_lengkap'],
                    'password'     => $data['password'],
                ]
            );
        }
    }
}