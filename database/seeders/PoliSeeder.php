<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poliData = [
            [
                'nama_poli' => 'POLI UMUM',
                'keterangan' => 'Pelayanan kesehatan umum dan pengobatan penyakit dalam',
            ],
            [
                'nama_poli' => 'POLI GIGI & MULUT',
                'keterangan' => 'Pelayanan kesehatan gigi dan mulut',
            ],
            [
                'nama_poli' => 'POLI KIA',
                'keterangan' => 'Kesehatan Ibu dan Anak',
            ],
            [
                'nama_poli' => 'LABORATORIUM',
                'keterangan' => 'Pemeriksaan laboratorium dan penunjang diagnostik',
            ],
            [
                'nama_poli' => 'POLI KB',
                'keterangan' => 'Keluarga Berencana',
            ],
            [
                'nama_poli' => 'POLI HIV & IMS',
                'keterangan' => 'Infeksi Menular Seksual',
            ],
            [
                'nama_poli' => 'POLI TB & RARU',
                'keterangan' => 'Tuberculosis & Respirasi Akut',
            ],
            [
                'nama_poli' => 'Home Visit',
                'keterangan' => 'Pelayanan kunjungan rumah',
            ],
            [
                'nama_poli' => 'Konseling',
                'keterangan' => 'Layanan konseling dan edukasi kesehatan',
            ],
            [
                'nama_poli' => 'Imunisasi (BCG)',
                'keterangan' => 'Imunisasi BCG untuk tuberculosis',
            ],
            [
                'nama_poli' => 'Imunisasi (DPT)',
                'keterangan' => 'Imunisasi DPT untuk difteri, pertusis, tetanus',
            ],
            [
                'nama_poli' => 'Imunisasi (Polio)',
                'keterangan' => 'Imunisasi polio',
            ],
            [
                'nama_poli' => 'Imunisasi (Campak)',
                'keterangan' => 'Imunisasi campak',
            ],
            [
                'nama_poli' => 'Imunisasi (Hep. B)',
                'keterangan' => 'Imunisasi Hepatitis B',
            ],
        ];

        foreach ($poliData as $data) {
            // Cek apakah poli sudah ada
            $existingPoli = DB::table('poli')
                ->where('nama_poli', $data['nama_poli'])
                ->first();

            if (!$existingPoli) {
                DB::table('poli')->insert([
                    'nama_poli' => $data['nama_poli'],
                    'keterangan' => $data['keterangan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}