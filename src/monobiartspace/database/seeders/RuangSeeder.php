<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangs = [
            [
                'nama' => 'Ruang Kreatif A',
                'kapasitas' => 20,
                'deskripsi' => 'Ruang multifungsi untuk kelas dan workshop seni lukis.',
            ],
            [
                'nama' => 'Ruang Imajinasi',
                'kapasitas' => 15,
                'deskripsi' => 'Ruang interaktif untuk anak-anak belajar sambil bermain.',
            ],
            [
                'nama' => 'Studio Keramik',
                'kapasitas' => 10,
                'deskripsi' => 'Studio khusus untuk pelatihan dan kegiatan seni keramik.',
            ],
            [
                'nama' => 'Ruang Ekspresi B',
                'kapasitas' => 25,
                'deskripsi' => 'Ruang besar untuk pameran hasil karya dan kegiatan kolaboratif.',
            ],
        ];

        foreach ($ruangs as $ruang) {
            Ruang::create($ruang);
        }
    }
}
