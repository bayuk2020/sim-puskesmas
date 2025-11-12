<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PasienUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Puskesmas',
                'email' => 'admin@puskesmas.test',
                'password' => bcrypt('password'),
                'role' => 'Admin', // enum sesuai migration
            ],
            [
                'name' => 'Petugas Medis',
                'email' => 'medis@puskesmas.test',
                'password' => bcrypt('password'),
                'role' => 'Dokter',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
