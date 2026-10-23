<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'id_user' => 'USRADM01',
                'nama_lengkap' => 'Admin',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => 'Admin123',
                'no_hp' => '081234567801',
                'alamat' => 'Bandung',
                'role' => 'admin',
            ],
            [
                'id_user' => 'USRCTM01',
                'nama_lengkap' => 'Customer',
                'email' => 'customer@example.com',
                'username' => 'customer',
                'password' => 'Customer123',
                'no_hp' => '081234567802',
                'alamat' => 'Bandung',
                'role' => 'customer',
            ],
            [
                'id_user' => 'USRSTF01',
                'nama_lengkap' => 'Staff',
                'email' => 'staff@example.com',
                'username' => 'staff',
                'password' => 'Staff123',
                'no_hp' => '081234567803',
                'alamat' => 'Bandung',
                'role' => 'staff',
            ],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrNew([
                'username' => $account['username'],
            ]);

            $isNew = ! $user->exists;

            $user->id_user = $account['id_user'];
            $user->nama_lengkap = $account['nama_lengkap'];
            $user->email = $account['email'];
            $user->no_hp = $account['no_hp'];
            $user->alamat = $account['alamat'];
            $user->role = $account['role'];

            if ($isNew) {
                $user->password = $account['password'];
            }

            $user->save();
        }
    }
}
