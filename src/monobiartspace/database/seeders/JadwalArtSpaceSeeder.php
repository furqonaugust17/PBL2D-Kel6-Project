<?php

namespace Database\Seeders;

use App\Models\JadwalArtSpace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalArtSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sesis = [
            ['sesi'  => 'Sesi 1', 'mulai' => '10:00', 'akhir' => '11:30', 'kapasitas' => 20],
            ['sesi'  => 'Sesi 2', 'mulai' => '12:00', 'akhir' => '13:30', 'kapasitas' => 20],
            ['sesi'  => 'Sesi 3', 'mulai' => '14:00', 'akhir' => '15:30', 'kapasitas' => 20],
            ['sesi'  => 'Sesi 4', 'mulai' => '16:00', 'akhir' => '17:30', 'kapasitas' => 20],
            ['sesi'  => 'Sesi 5', 'mulai' => '18:00', 'akhir' => '19:30', 'kapasitas' => 20],
        ];

        foreach ($sesis as $index => $sesi) {
            JadwalArtSpace::create($sesi);
        }
    }
}
