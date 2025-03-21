<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('obat')->insert([
            'nama_obat' => 'Paracetamol',
            'kemasan' => 'Strip',
            'harga' => 10000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('obat')->insert([
            'nama_obat' => 'Amoxicillin',
            'kemasan' => 'Botol',
            'harga' => 25000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('obat')->insert([
            'nama_obat' => 'Antasida',
            'kemasan' => 'Botol',
            'harga' => 15000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('obat')->insert([
            'nama_obat' => 'Vitamin C',
            'kemasan' => 'Strip',
            'harga' => 12000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('obat')->insert([
            'nama_obat' => 'Omeprazole',
            'kemasan' => 'Strip',
            'harga' => 35000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}