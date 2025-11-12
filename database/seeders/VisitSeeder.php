<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;
use App\Models\Pasien;
use App\Models\Poli;

class VisitSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = Pasien::all();
        $polis = Poli::all();

        if ($pasiens->count() == 0 || $polis->count() == 0) {
            $this->command->info('⚠️ Pastikan data pasien dan poli sudah ada.');
            return;
        }

        foreach ($pasiens as $pasien) {
            $poli = $polis->random();

            Visit::create([
                'id_pasien' => $pasien->id_pasien,
                'id_poli' => $poli->id_poli,
                'visit_date' => now(),
                'keluhan' => fake()->sentence(5),
                'diagnosa' => fake()->sentence(3),
                'tindakan' => fake()->word(),
            ]);
        }

        $this->command->info('✅ Data kunjungan berhasil dibuat.');
    }
}
