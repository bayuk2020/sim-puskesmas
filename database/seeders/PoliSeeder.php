<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $poliList = [
            'Poli Umum',
            'Poli Gigi',
            'Poli Anak',
            'Poli KIA',
            'Poli Penyakit Dalam',
        ];

        foreach ($poliList as $nama) {
            Poli::create(['nama_poli' => $nama]);
        }
    }
}
