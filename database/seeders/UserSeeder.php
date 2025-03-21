<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dokter
        DB::table('users')->insert([
            'nama' => 'Dr. Budi Santoso',
            'alamat' => 'Jl. Kenangan No. 10, Jakarta',
            'no_hp' => '08123456789',
            'email' => 'budi.dokter@example.com',
            'role' => 'dokter',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nama' => 'Dr. Siti Rahayu',
            'alamat' => 'Jl. Merdeka No. 45, Bandung',
            'no_hp' => '08234567890',
            'email' => 'siti.dokter@example.com',
            'role' => 'dokter',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Data pasien
        DB::table('users')->insert([
            'nama' => 'Ahmad Setiawan',
            'alamat' => 'Jl. Dahlia No. 12, Surabaya',
            'no_hp' => '08345678901',
            'email' => 'ahmad@example.com',
            'role' => 'pasien',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nama' => 'Rina Wulandari',
            'alamat' => 'Jl. Anggrek No. 23, Yogyakarta',
            'no_hp' => '08456789012',
            'email' => 'rina@example.com',
            'role' => 'pasien',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Data admin
        DB::table('users')->insert([
            'nama' => 'Admin Sistem',
            'alamat' => 'Jl. Admin No. 1, Jakarta',
            'no_hp' => '08567890123',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}