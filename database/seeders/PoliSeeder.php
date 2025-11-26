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
                'kode_poli' => 'PU',
            ],
            [
                'nama_poli' => 'POLI GIGI & MULUT',
                'keterangan' => 'Pelayanan kesehatan gigi dan mulut',
                'kode_poli' => 'PGM',
            ],
            [
                'nama_poli' => 'POLI KIA',
                'keterangan' => 'Kesehatan Ibu dan Anak',
                'kode_poli' => 'PKIA',
            ],
            [
                'nama_poli' => 'LABORATORIUM',
                'keterangan' => 'Pemeriksaan laboratorium dan penunjang diagnostik',
                'kode_poli' => 'LAB',
            ],
            [
                'nama_poli' => 'POLI KB',
                'keterangan' => 'Keluarga Berencana',
                'kode_poli' => 'PKB',
            ],
            [
                'nama_poli' => 'POLI HIV & IMS',
                'keterangan' => 'Infeksi Menular Seksual',
                'kode_poli' => 'PHIV',
            ],
            [
                'nama_poli' => 'POLI TB & RARU',
                'keterangan' => 'Tuberculosis & Respirasi Akut',
                'kode_poli' => 'PTB',
            ],
            [
                'nama_poli' => 'Home Visit',
                'keterangan' => 'Pelayanan kunjungan rumah',
                'kode_poli' => 'HV',
            ],
            [
                'nama_poli' => 'Konseling',
                'keterangan' => 'Layanan konseling dan edukasi kesehatan',
                'kode_poli' => 'KON',
            ],
            [
                'nama_poli' => 'Imunisasi (BCG)',
                'keterangan' => 'Imunisasi BCG untuk tuberculosis',
                'kode_poli' => 'IMB',
            ],
            [
                'nama_poli' => 'Imunisasi (DPT)',
                'keterangan' => 'Imunisasi DPT untuk difteri, pertusis, tetanus',
                'kode_poli' => 'IMD',
            ],
            [
                'nama_poli' => 'Imunisasi (Polio)',
                'keterangan' => 'Imunisasi polio',
                'kode_poli' => 'IMP',
            ],
            [
                'nama_poli' => 'Imunisasi (Campak)',
                'keterangan' => 'Imunisasi campak',
                'kode_poli' => 'IMC',
            ],
            [
                'nama_poli' => 'Imunisasi (Hep. B)',
                'keterangan' => 'Imunisasi Hepatitis B',
                'kode_poli' => 'IMH',
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
                    'kode_poli' => $data['kode_poli'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}