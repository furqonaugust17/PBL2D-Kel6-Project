<?php

namespace Database\Seeders;

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
        $KiddyNest = Kid::create(['nama' => 'Kiddy Nest']);
        $RegularClass = Kid::create(['nama' => 'Regular Class']);

        $kategoriKiddy = [
            ['nama'   => 'Kiddy Explorer', 'deskripsi' => '(2-5 tahun)'],
            ['nama' => 'Kindergarten', 'deskripsi' => '(3-5 tahun)']
        ];

        $kategoriRegular = [
            ['nama'   => 'Baby class', 'deskripsi' => '(10 - 18 bulan)'],
            ['nama' => 'Pre toddler', 'deskripsi' => '(1,5 - 2,5 tahun)'],
            ['nama' => 'Toddler', 'deskripsi' => '(2,5 - 5 tahun)']
        ];

        foreach ($kategoriKiddy as $kiddy) {
            KategoriKid::create([
                'nama'  => $kiddy['nama'],
                'deskripsi' => $kiddy['deskripsi'],
                'kid_id' => $KiddyNest->id
            ]);
        }

        foreach ($kategoriRegular as $regular) {
            KategoriKid::create([
                'nama'  => $regular['nama'],
                'deskripsi' => $regular['deskripsi'],
                'kid_id' => $RegularClass->id
            ]);
        }

        $temas = [
            [
                'nama' => 'THE LIGHT OF HAPPINESS IN SPRING',
                'waktu' => '2025-07-01',
                'kid_id' => $KiddyNest->id,
                'deskripsi' => 'Musim semi datang membawa kehangatan, keceriaan, dan harapan baru! Dalam tema ini, anak-anak diajak mengenal keindahan alam di musim semi, mulai dari bunga-bunga yang bermekaran, binatang kecil yang kembali aktif, hingga sinar mentari yang lembut. Aktivitas yang disiapkan akan menstimulasi rasa ingin tahu dan kreativitas anak terhadap lingkungan sekitar.',
                'details' => [
                    ['nama' => 'Flowers in Bloom', 'week' => 1],
                    ['nama' => 'The Best Bird\'s Nest', 'week' => 2],
                    ['nama' => 'Sweet Little Ladybug', 'week' => 3],
                    ['nama' => 'Warm Sunshine', 'week' => 4],
                ]
            ],
            [
                'nama' => 'UNDER THE SEA ADVENTURE',
                'waktu' => '2025-08-01',
                'kid_id' => $KiddyNest->id,
                'deskripsi' => 'Selamat datang di petualangan bawah laut yang penuh warna dan keajaiban! Anak-anak akan menyelami dunia lautan bersama hewan-hewan laut yang unik dan menakjubkan. Tema ini mengajak anak mengenal kehidupan di bawah laut serta pentingnya menjaga kebersihan laut melalui kegiatan yang menyenangkan dan interaktif.',
                'details' => [
                    ['nama' => 'Treasure Hunt with Turtles', 'week' => 1],
                    ['nama' => 'Dancing with Dolphins', 'week' => 2],
                    ['nama' => 'Crabby Crab Creations', 'week' => 3],
                    ['nama' => 'Magical Mermaid Parade', 'week' => 4],
                ]
            ],
            [
                'nama' => 'DINOSAUR DISCOVERY WORLD',
                'waktu' => '2025-09-01',
                'kid_id' => $RegularClass->id,
                'deskripsi' => 'Mari menjelajah ke masa lalu! Tema ini membawa anak-anak ke zaman dinosaurus yang penuh misteri dan petualangan. Melalui eksperimen, simulasi, dan permainan, anak akan belajar mengenali berbagai jenis dinosaurus, habitatnya, serta bagaimana mereka hidup di zaman purba.',
                'details' => [
                    ['nama' => 'T-Rex\'s Big Roar', 'week' => 1],
                    ['nama' => 'Dino Egg Hunt', 'week' => 2],
                    ['nama' => 'Volcano Lava Lab', 'week' => 3],
                    ['nama' => 'Dino Parade Day', 'week' => 4],
                ]
            ],
            [
                'nama' => 'GALAXY EXPLORER',
                'waktu' => '2025-10-01',
                'kid_id' => $RegularClass->id,
                'deskripsi' => 'Bersiap untuk terbang ke luar angkasa! Dalam tema ini, anak-anak akan berperan sebagai penjelajah galaksi yang menjelajahi planet, bintang, hingga makhluk luar angkasa. Anak akan diajak berimajinasi, membangun roket, serta memahami konsep sederhana tentang tata surya dan sains luar angkasa melalui kegiatan yang edukatif dan menyenangkan.',
                'details' => [
                    ['nama' => 'Mission: Moon Landing', 'week' => 1],
                    ['nama' => 'Aliens and UFO Friends', 'week' => 2],
                    ['nama' => 'Rocket Building Workshop', 'week' => 3],
                    ['nama' => 'Stargazing Celebration', 'week' => 4],
                ]
            ]
        ];

        foreach ($temas as $tema) {
            $createdTema = TemaKid::create([
                'nama' => $tema['nama'],
                'deskripsi' => $tema['deskripsi'],
                'waktu' => $tema['waktu'],
                'kid_id' => $tema['kid_id'],
            ]);

            $createdTema->detailTema()->createMany($tema['details']);
        }
    }
}
