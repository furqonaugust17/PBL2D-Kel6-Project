<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'image' => 'uploads/gallery/default/beads-class.jpg',
                'deskripsi' => 'Kelas kerajinan manik-manik yang menyenangkan untuk anak-anak.',
            ],
            [
                'image' => 'uploads/gallery/default/event_collaboration.jpg',
                'deskripsi' => 'Kolaborasi seru Monobi dengan komunitas seni lokal.',
            ],
            [
                'image' => 'uploads/gallery/default/class_education.jpg',
                'deskripsi' => 'Suasana kelas edukatif yang penuh antusiasme.',
            ],
            [
                'image' => 'uploads/gallery/default/outingclass_sd26jatiutara.jpg',
                'deskripsi' => 'Kegiatan outing class bersama SDN 26 Jati Utara.',
            ],
            [
                'image' => 'uploads/gallery/default/outingclass_sd26jatiutara2.jpg',
                'deskripsi' => 'Dokumentasi momen belajar seru di luar kelas.',
            ],
            [
                'image' => 'uploads/gallery/default/monobi_after_school.jpg',
                'deskripsi' => 'Program after school kreatif untuk mengembangkan bakat.',
            ],
            [
                'image' => 'uploads/gallery/default/monobi_after_school2.jpg',
                'deskripsi' => 'Aktivitas menyenangkan di kelas after school Monobi.',
            ],
        ];

        foreach ($datas as $data) {
            Galeri::create($data);
        }
    }
}
