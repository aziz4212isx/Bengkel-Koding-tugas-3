<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Detail pemeriksaan 1
        DB::table('detail_periksa')->insert([
            'id_periksa' => 1,
            'id_obat' => 1, // Paracetamol
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('detail_periksa')->insert([
            'id_periksa' => 1,
            'id_obat' => 4, // Vitamin C
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Detail pemeriksaan 2
        DB::table('detail_periksa')->insert([
            'id_periksa' => 2,
            'id_obat' => 3, // Antasida
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('detail_periksa')->insert([
            'id_periksa' => 2,
            'id_obat' => 5, // Omeprazole
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Detail pemeriksaan 3
        DB::table('detail_periksa')->insert([
            'id_periksa' => 3,
            'id_obat' => 2, // Amoxicillin
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('detail_periksa')->insert([
            'id_periksa' => 3,
            'id_obat' => 4, // Vitamin C
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Detail pemeriksaan 4
        DB::table('detail_periksa')->insert([
            'id_periksa' => 4,
            'id_obat' => 2, // Amoxicillin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}