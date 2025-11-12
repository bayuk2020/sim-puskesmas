<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);
        $firstName = $gender === 'L' 
            ? $this->faker->firstNameMale() 
            : $this->faker->firstNameFemale();
        
        return [
            'no_rm' => $this->faker->unique()->numerify('##########'), // max 10 digit
            'nik' => $this->faker->numerify('32################'), // 16 digit NIK
            'nama_pasien' => $firstName . ' ' . $this->faker->lastName(),
            'jenis_kelamin' => $gender,
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->numerify('08##########'),
            'status_perkawinan' => $this->faker->randomElement([
                'Belum Kawin', 
                'Kawin', 
                'Cerai Hidup', 
                'Cerai Mati'
            ]),
            'pekerjaan' => $this->faker->randomElement([
                'Wiraswasta',
                'Pegawai Negeri',
                'Karyawan Swasta',
                'Mahasiswa',
                'Ibu Rumah Tangga',
                'Pelajar',
                'Dokter',
                'Guru',
                'Pedagang',
                'Buruh',
                'Petani',
                'Nelayan'
            ]),
            'tanggal_daftar' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}