<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pemeriksaan 1
        DB::table('periksa')->insert([
            'id_pasien' => 3, // Ahmad Setiawan
            'id_dokter' => 1, // Dr. Budi Santoso
            'tgl_periksa' => '2023-03-15 09:30:00',
            'catatan' => 'Pasien mengeluh demam dan sakit kepala selama 2 hari. Diberikan paracetamol dan vitamin C.',
            'biaya_periksa' => 150000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pemeriksaan 2
        DB::table('periksa')->insert([
            'id_pasien' => 4, // Rina Wulandari
            'id_dokter' => 2, // Dr. Siti Rahayu
            'tgl_periksa' => '2023-03-16 13:45:00',
            'catatan' => 'Pasien mengeluh sakit perut dan mual. Diberikan antasida dan omeprazole.',
            'biaya_periksa' => 175000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pemeriksaan 3
        DB::table('periksa')->insert([
            'id_pasien' => 3, // Ahmad Setiawan
            'id_dokter' => 2, // Dr. Siti Rahayu
            'tgl_periksa' => '2023-03-20 10:15:00',
            'catatan' => 'Pasien mengeluh batuk dan pilek. Diberikan obat batuk dan vitamin C.',
            'biaya_periksa' => 130000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pemeriksaan 4
        DB::table('periksa')->insert([
            'id_pasien' => 4, // Rina Wulandari
            'id_dokter' => 1, // Dr. Budi Santoso
            'tgl_periksa' => '2023-03-22 14:30:00',
            'catatan' => 'Pasien mengeluh gatal-gatal dan ruam di kulit. Diberikan antihistamin.',
            'biaya_periksa' => 160000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}