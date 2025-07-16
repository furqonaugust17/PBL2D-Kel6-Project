<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventaris;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama_barang' => 'Kanvas Lukis 40x60',
                'kategori' => 'Alat Lukis',
                'jumlah_stok_awal' => 50,
                'keterangan' => 'Kanvas polos ukuran standar untuk kelas melukis.',
            ],
            [
                'nama_barang' => 'Kursi Anak',
                'kategori' => 'Perabot',
                'jumlah_stok_awal' => 30,
                'keterangan' => 'Kursi plastik khusus anak-anak berwarna cerah.',
            ],
            [
                'nama_barang' => 'Rak Penyimpanan',
                'kategori' => 'Perabot',
                'jumlah_stok_awal' => 10,
                'keterangan' => 'Rak kayu untuk menyimpan perlengkapan kelas.',
            ],
            [
                'nama_barang' => 'Pensil Warna 24 Warna',
                'kategori' => 'Alat Gambar',
                'jumlah_stok_awal' => 100,
                'keterangan' => 'Pensil warna merk Faber-Castell isi 24 warna.',
            ],
            [
                'nama_barang' => 'Paket Cat Akrilik',
                'kategori' => 'Alat Lukis',
                'jumlah_stok_awal' => 40,
                'keterangan' => 'Terdiri dari 12 warna cat akrilik ukuran kecil.',
            ],
        ];

        foreach ($datas as $data) {
            Inventaris::create($data);
        }
    }
}
