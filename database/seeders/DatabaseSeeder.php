<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User contoh (opsional)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seeder urutan logis
        $this->call([
            PoliSeeder::class,       // buat data poli dulu
            PasienSeeder::class,     // buat data pasien
            PasienUserSeeder::class, // buat user
            VisitSeeder::class,      // buat kunjungan pasien
        ]);
    }
}
