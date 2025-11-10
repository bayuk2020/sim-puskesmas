<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    User::firstOrCreate(['email'=>'admin@simpus.local'], [
      'name'=>'Administrator',
      'password'=>Hash::make('password123'),
      'role'=>'Admin',
      'email_verified_at'=>now(),
    ]);
    }
}
