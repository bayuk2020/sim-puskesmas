<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawaiData = [
            [
                'nip' => '001',
                'nama_pegawai' => 'Admin Utama',
                'jabatan' => 'Admin',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Admin No. 1',
                'no_hp' => '081234567890',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '002', 
                'nama_pegawai' => 'Dr. Andi Wijaya',
                'jabatan' => 'Dokter Umum',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Dokter No. 2',
                'no_hp' => '081234567891',
                'username' => 'dokter_andi',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '003',
                'nama_pegawai' => 'Drg. Sari Dewi', 
                'jabatan' => 'Dokter Gigi',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Gigi No. 3',
                'no_hp' => '081234567892',
                'username' => 'dokter_sari',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '004',
                'nama_pegawai' => 'Nurse Lisa',
                'jabatan' => 'Perawat',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Perawat No. 4',
                'no_hp' => '081234567893',
                'username' => 'perawat_lisa',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '005',
                'nama_pegawai' => 'Apoteker Budi',
                'jabatan' => 'Farmasi',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Farmasi No. 5',
                'no_hp' => '081234567894',
                'username' => 'farmasi_budi',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '006',
                'nama_pegawai' => 'Kasir Rina',
                'jabatan' => 'Kasir',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Kasir No. 6',
                'no_hp' => '081234567895',
                'username' => 'kasir_rina',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '007',
                'nama_pegawai' => 'Petugas Loket',
                'jabatan' => 'Loket',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Loket No. 7',
                'no_hp' => '081234567896',
                'username' => 'loket_joko',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '008',
                'nama_pegawai' => 'Bidan Maya',
                'jabatan' => 'Bidan',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Bidan No. 8',
                'no_hp' => '081234567897',
                'username' => 'bidan_maya',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '009',
                'nama_pegawai' => 'Laboran Dodi',
                'jabatan' => 'Laboran',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Laboratorium No. 9',
                'no_hp' => '081234567898',
                'username' => 'laboran_dodi',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
            [
                'nip' => '010',
                'nama_pegawai' => 'Dokter KIA',
                'jabatan' => 'KIA',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. KIA No. 10',
                'no_hp' => '081234567899',
                'username' => 'kia_sari',
                'password' => Hash::make('password123'),
                'status' => 'Aktif',
            ],
        ];

        foreach ($pegawaiData as $data) {
            // Cek apakah username sudah ada di pegawai
            $existingPegawai = DB::table('pegawai')
                ->where('username', $data['username'])
                ->first();

            if (!$existingPegawai) {
                // Insert ke tabel users
                $userId = DB::table('users')->insertGetId([
                    'name' => $data['nama_pegawai'],
                    'email' => $data['username'] . '@klinik.com',
                    'password' => $data['password'], // Password sama
                    'role' => $this->mapJabatanToRole($data['jabatan']),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert ke tabel pegawai dengan struktur yang sesuai
                DB::table('pegawai')->insert([
                    'nip' => $data['nip'],
                    'nama_pegawai' => $data['nama_pegawai'],
                    'jabatan' => $data['jabatan'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'alamat' => $data['alamat'],
                    'no_hp' => $data['no_hp'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                    'status' => $data['status'],
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Map jabatan ke role untuk tabel users
     */
    private function mapJabatanToRole(string $jabatan): string
    {
        return match($jabatan) {
            'Admin' => 'Admin',
            'Dokter Umum', 'Dokter Gigi', 'KIA' => 'Dokter',
            'Perawat', 'Bidan' => 'Perawat',
            'Farmasi' => 'Farmasi',
            'Kasir' => 'Kasir',
            'Loket', 'Laboran' => 'Admin', // Bisa disesuaikan
            default => 'Admin'
        };
    }
}