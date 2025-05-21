<?php

namespace Database\Seeders;

use App\Models\ArtSpace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paintingClass = ArtSpace::create(['nama' => 'Painting Class']);
        $kegiatanPainting = [
            ['nama' => 'Painting on canvas', 'harga' => 68000],
            ['nama' => 'Painting on Pouch', 'harga' => 68000],
            ['nama' => 'Painting on Bucket Hat', 'harga' => 68000],
            ['nama' => 'Wallet Painting', 'harga' => 68000],
            ['nama' => 'Mirror Painting', 'harga' => 68000],
            ['nama' => 'Mirror Painting aesthetic', 'harga' => 85000],
            ['nama' => 'Painting on Totebag', 'harga' => 78000],
            ['nama' => 'Watercolor Paintinng', 'harga' => 45000],
            ['nama' => 'Bear Brick Keychain Painting', 'harga' => 45000],
            ['nama' => 'Rabbit Painting', 'harga' => 100000],
            ['nama' => 'Bear Brick Painting', 'harga' => 90000],
            ['nama' => 'Gypsum Painting', 'harga' => 68000],
            ['nama' => 'Pot Painting', 'harga' => 60000],
            ['nama' => 'Pot painting + cactus', 'harga' => 68000],
        ];

        foreach ($kegiatanPainting as $painting) {
            KegiatanArtSpace::create([
                'nama' => $painting['nama'],
                'harga' => $painting['harga'],
                'artspace_id'   => $paintingClass->id
            ]);
        }

        $funclayClass = ArtSpace::create(['nama' => 'Funclay Class']);
        $kegitanFunclay = [
            ['nama' => 'Air Dry Clay', 'harga' => 60000],
            ['nama' => 'Paint Clay', 'harga' => 70000],
            ['nama' => 'Diy Clay Painting', 'harga' => 90000],
            ['nama' => 'Frame sotf clay', 'harga' => 75000],
            ['nama' => 'Mirror soft clay', 'harga' => 75000],
        ];

        foreach ($kegitanFunclay as $funclay) {
            KegiatanArtSpace::create([
                'nama' => $funclay['nama'],
                'harga' => $funclay['harga'],
                'artspace_id'   => $funclayClass->id
            ]);
        }

        $beadsClass = ArtSpace::create(['nama' => 'Beads Class']);
        $kegiatanBeadClass = [
            ['nama' => 'Beads Cup kecil', 'harga' => 35000],
            ['nama' => 'Beads Cup Besar', 'harga' => 50000],
        ];

        foreach ($kegiatanBeadClass as $funclay) {
            KegiatanArtSpace::create([
                'nama' => $funclay['nama'],
                'harga' => $funclay['harga'],
                'artspace_id'   => $beadsClass->id
            ]);
        }

        $decoCreamClass = ArtSpace::create(['nama' => 'DIY Deco Cream']);
        $kegiatanDecoCream = [
            ['nama' => 'Mirror Deco Cream', 'harga' => 70000],
            ['nama' => 'Keychain Deco Cream', 'harga' => 25000],
            ['nama' => 'Frame Deco Cream', 'harga' => 75000],
            ['nama' => 'Case Deco Cream', 'harga' => 75000],
        ];

        foreach ($kegiatanDecoCream as $deco) {
            KegiatanArtSpace::create([
                'nama' => $deco['nama'],
                'harga' => $deco['harga'],
                'artspace_id'   => $decoCreamClass->id
            ]);
        }

        $sessions = [
            ['sesi' => 'Sesi 1', 'mulai' => '10:00', 'akhir' => '11:30'],
            ['sesi' => 'Sesi 2', 'mulai' => '12:00', 'akhir' => '13:30'],
        ];

        foreach ($sessions as $session) {
            JadwalArtSpace::create([
                'sesi'  => $session['sesi'],
                'mulai'  => $session['mulai'],
                'akhir'  => $session['akhir'],
            ]);
        }
    }
}
