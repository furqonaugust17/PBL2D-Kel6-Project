<?php

namespace Database\Seeders;

use App\Models\DetailTemaKid;
use App\Models\JadwalKid;
use App\Models\KategoriKid;
use App\Models\Kid;
use App\Models\TemaKid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kiddyNest = Kid::create([
            'nama'  => 'Kiddy Nest'
        ]);

        $kategoriKiddy = [
            ['nama'   => 'Kiddy Explorer', 'deskripsi' => '(2-5 tahun)'],
            ['nama' => 'Kindergarten', 'deskripsi' => '(3-5 tahun)']
        ];

        foreach ($kategoriKiddy as $kiddy) {
            KategoriKid::create([
                'nama'  => $kiddy['nama'],
                'deskripsi' => $kiddy['deskripsi'],
                'kid_id' => $kiddyNest->id
            ]);
        }

        $temaKiddyNest = TemaKid::create([
            'nama'  => 'THE LIGHT OF HAPPINES IN SPRING',
            'waktu' => '2025-05-01',
            'kid_id'   => $kiddyNest->id
        ]);

        $detailTemaKiddyNest = ['Flowers in Bloom', "The Best Bird's Nest", 'Sweet Little Ladybug', 'Warm Shunshine'];
        foreach ($detailTemaKiddyNest as $index => $temaKiddy) {
            DetailTemaKid::create([
                'week'  => ($index + 1),
                'nama' => $temaKiddy,
                'tema_kid_id'   => $temaKiddyNest->id,
            ]);
        }

        $jadwals = [
            ['hari' => 'senin', 'mulai' => '10:00', 'akhir' => '11:00'],
            ['hari' => 'selasa', 'mulai' => '10:00', 'akhir' => '11:00'],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalKid::create([
                'hari' => $jadwal['hari'],
                'mulai' => $jadwal['mulai'],
                'akhir' => $jadwal['akhir'],
                'kategori_id' => 1
            ]);
        }
    }
}
