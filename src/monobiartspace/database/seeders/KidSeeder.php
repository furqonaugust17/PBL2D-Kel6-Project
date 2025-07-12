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
        $hargaKiddyNest = [
            ['harga' => 110000, 'jumlah_pertemuan' => 1, 'deskripsi' => 'Normal Fee 110k/Meet'],
            ['harga' => 320000, 'jumlah_pertemuan' => 3, 'deskripsi' => 'Bundling 3 week 320k/3 meet'],
            ['harga' => 410000, 'jumlah_pertemuan' => 4, 'deskripsi' => 'Bundling 4 week 410k/4 meet']
        ];
        $KiddyNest->harga()->createMany($hargaKiddyNest);

        $RegularClass = Kid::create(['nama' => 'Regular Class']);
        $hargaRegularClass = [
            ['harga' => 80000, 'jumlah_pertemuan' => 1, 'deskripsi' => 'Normal Fee 80k/Meet'],
            ['harga' => 230000, 'jumlah_pertemuan' => 3, 'deskripsi' => 'Bundling 3 week 230k/3 meet'],
            ['harga' => 300000, 'jumlah_pertemuan' => 4, 'deskripsi' => 'Bundling 4 week 300k/4 meet']
        ];
        $RegularClass->harga()->createMany($hargaRegularClass);

        $kategoriKiddy = [
            ['nama'   => 'Kiddy Explorer', 'deskripsi' => '(2-5 tahun)', 'jadwal' => [
                ['hari' => 'Senin', 'mulai' => '07:00', 'akhir' => '08:00', 'kapasitas' => 6],
                ['hari' => 'Selasa', 'mulai' => '07:00', 'akhir' => '08:00', 'kapasitas' => 6],
                ['hari' => 'Rabu', 'mulai' => '07:00', 'akhir' => '08:00', 'kapasitas' => 6]
            ]],
            ['nama' => 'Kindergarten', 'deskripsi' => '(3-5 tahun)', 'jadwal' => [
                ['hari' => 'Senin', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6],
                ['hari' => 'Selasa', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6],
                ['hari' => 'Rabu', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6]
            ]]
        ];

        $kategoriRegular = [
            ['nama'   => 'Baby class', 'deskripsi' => '(10 - 18 bulan)', 'jadwal' => [
                ['hari' => 'Senin', 'mulai' => '07:00', 'akhir' => '08:00', 'kapasitas' => 6],
                ['hari' => 'Selasa', 'mulai' => '07:00', 'akhir' => '08:00', 'kapasitas' => 6],
                ['hari' => 'Rabu', 'mulai' => '07:00', 'akhir' => '08:00', 'kapasitas' => 6]
            ]],
            ['nama' => 'Pre toddler', 'deskripsi' => '(1,5 - 2,5 tahun)', 'jadwal' => [
                ['hari' => 'Senin', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6],
                ['hari' => 'Selasa', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6],
                ['hari' => 'Rabu', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6]
            ]],
            ['nama' => 'Toddler', 'deskripsi' => '(2,5 - 5 tahun)', 'jadwal' => [
                ['hari' => 'Senin', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6],
                ['hari' => 'Selasa', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6],
                ['hari' => 'Rabu', 'mulai' => '09:00', 'akhir' => '10:00', 'kapasitas' => 6]
            ]]
        ];

        foreach ($kategoriKiddy as $kiddy) {
            $dataKiddy = KategoriKid::create([
                'nama'  => $kiddy['nama'],
                'deskripsi' => $kiddy['deskripsi'],
                'kid_id' => $KiddyNest->id
            ]);
            $dataKiddy->jadwal()->createMany($kiddy['jadwal']);
        }

        foreach ($kategoriRegular as $regular) {
            $dataRegular = KategoriKid::create([
                'nama'  => $regular['nama'],
                'deskripsi' => $regular['deskripsi'],
                'kid_id' => $RegularClass->id
            ]);
            $dataRegular->jadwal()->createMany($kiddy['jadwal']);
        }

        $temas = [
            [
                'nama' => 'LITTLE SCIENTIST',
                'waktu' => '2025-07-01',
                'kid_id' => $KiddyNest->id,
                'deskripsi' => 'Musim semi datang membawa kehangatan, keceriaan, dan harapan baru! Dalam tema ini, anak-anak diajak mengenal keindahan alam di musim semi, mulai dari bunga-bunga yang bermekaran, binatang kecil yang kembali aktif, hingga sinar mentari yang lembut. Aktivitas yang disiapkan akan menstimulasi rasa ingin tahu dan kreativitas anak terhadap lingkungan sekitar.',
                'details' => [
                    ['nama' => 'Bagaimana Letusan Gunung Berapa Terjadi?', 'week' => 1],
                    ['nama' => 'Mengapa Bunga Mekar?', 'week' => 2],
                    ['nama' => 'Bagaimana Roket Bisa Terbang?', 'week' => 3],
                    ['nama' => 'Apa Itu Tornado?', 'week' => 4],
                ],
                'images' => [
                    ['file'  => 'uploads/tema/kiddy/1.jpg'],
                    ['file'  => 'uploads/tema/kiddy/2.jpg'],
                    ['file'  => 'uploads/tema/kiddy/3.jpg'],
                    ['file'  => 'uploads/tema/kiddy/4.jpg'],
                    ['file'  => 'uploads/tema/kiddy/5.jpg'],
                ]
            ],
            [
                'nama' => 'Regular Class on July',
                'waktu' => '2025-09-01',
                'kid_id' => $RegularClass->id,
                'deskripsi' => 'Mari menjelajah ke masa lalu! Tema ini membawa anak-anak ke zaman dinosaurus yang penuh misteri dan petualangan. Melalui eksperimen, simulasi, dan permainan, anak akan belajar mengenali berbagai jenis dinosaurus, habitatnya, serta bagaimana mereka hidup di zaman purba.',
                'details' => [
                    ['nama' => 'Ocean Beach', 'week' => 1],
                    ['nama' => 'Sea Turtle', 'week' => 2],
                    ['nama' => 'Children Day\'s', 'week' => 3],
                    ['nama' => 'Watermelom', 'week' => 4],
                ],
                'images' => [
                    ['file'  => 'uploads/tema/regular/1.jpg'],
                    ['file'  => 'uploads/tema/regular/2.jpg'],
                    ['file'  => 'uploads/tema/regular/3.jpg'],
                    ['file'  => 'uploads/tema/regular/4.jpg'],
                ]
            ],
        ];

        foreach ($temas as $tema) {
            $createdTema = TemaKid::create([
                'nama' => $tema['nama'],
                'deskripsi' => $tema['deskripsi'],
                'waktu' => $tema['waktu'],
                'kid_id' => $tema['kid_id'],
            ]);

            $createdTema->detailTema()->createMany($tema['details']);
            $createdTema->images()->createMany($tema['images']);
        }
    }
}
