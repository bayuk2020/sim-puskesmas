<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        Pasien::create([
            'no_rm' => 'RM001',
            'nik' => '1234567890123456',
            'nama_pasien' => 'Budi Santoso',
            'jenis_kelamin' => 'L',   // L = Laki-laki, P = Perempuan
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => '1990-05-15',
            'alamat' => 'Jl. Merpati No. 10',
            'no_hp' => '081234567890',
            'status_perkawinan' => 'Kawin', // ✅ harus sama persis
            'pekerjaan' => 'Karyawan',
            'tanggal_daftar' => now(),
        ]);

        Pasien::create([
            'no_rm' => 'RM002',
            'nik' => '1234567890123457',
            'nama_pasien' => 'Siti Aminah',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Ungaran',
            'tanggal_lahir' => '1985-09-22',
            'alamat' => 'Jl. Anggrek No. 25',
            'no_hp' => '082134567891',
            'status_perkawinan' => 'Kawin', // ✅ sama persis
            'pekerjaan' => 'Ibu Rumah Tangga',
            'tanggal_daftar' => now(),
        ]);

        Pasien::create([
            'no_rm' => 'RM003',
            'nik' => '1234567890123458',
            'nama_pasien' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => '1992-07-12',
            'alamat' => 'Jl. Mawar No. 5',
            'no_hp' => '081234567892',
            'status_perkawinan' => 'Belum Kawin', // ✅ huruf besar & spasi sesuai enum
            'pekerjaan' => 'Mahasiswa',
            'tanggal_daftar' => now(),
        ]);
    }
}
