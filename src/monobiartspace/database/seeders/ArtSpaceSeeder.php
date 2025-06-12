<?php

namespace Database\Seeders;

use App\Models\ArtSpace;
use App\Models\JadwalArtSpace;
use App\Models\KegiatanArtSpace;
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
            ['nama' => 'Painting on canvas', 'harga' => 68000, 'deskripsi' => 'Melukis di atas kanvas seperti seniman kecil, mengasah kreativitas dan ekspresi bebas.'],
            ['nama' => 'Painting on Pouch', 'harga' => 68000, 'deskripsi' => 'Mewarnai pouch lucu yang bisa dibawa pulang dan digunakan sehari-hari.'],
            ['nama' => 'Painting on Bucket Hat', 'harga' => 68000, 'deskripsi' => 'Menghias topi bucket dengan desain unik hasil karya sendiri.'],
            ['nama' => 'Wallet Painting', 'harga' => 68000, 'deskripsi' => 'Melukis dompet mini lucu sebagai hasil karya yang bisa dipakai.'],
            ['nama' => 'Mirror Painting', 'harga' => 68000, 'deskripsi' => 'Cermin kecil dihias dengan kreativitas penuh warna.'],
            ['nama' => 'Mirror Painting aesthetic', 'harga' => 85000, 'deskripsi' => 'Cermin dihias dengan gaya estetik kekinian yang cocok untuk dekorasi.'],
            ['nama' => 'Painting on Totebag', 'harga' => 78000, 'deskripsi' => 'Melukis totebag dengan gambar favorit dan hasilnya bisa dipakai ke mana saja.'],
            ['nama' => 'Watercolor Painting', 'harga' => 45000, 'deskripsi' => 'Belajar teknik cat air dengan cara yang ringan dan menyenangkan.'],
            ['nama' => 'Bear Brick Keychain Painting', 'harga' => 45000, 'deskripsi' => 'Melukis gantungan kunci Bear Brick kecil yang lucu dan bisa dibawa pulang.'],
            ['nama' => 'Rabbit Painting', 'harga' => 100000, 'deskripsi' => 'Melukis patung kelinci lucu yang cocok untuk pajangan anak.'],
            ['nama' => 'Bear Brick Painting', 'harga' => 90000, 'deskripsi' => 'Melukis figur Bear Brick versi besar dengan warna dan karakter sesuai selera.'],
            ['nama' => 'Gypsum Painting', 'harga' => 68000, 'deskripsi' => 'Melukis bentuk gypsum edukatif seperti hewan, karakter, dan lainnya.'],
            ['nama' => 'Pot Painting', 'harga' => 60000, 'deskripsi' => 'Melukis pot tanaman untuk dibawa pulang sebagai dekorasi meja atau taman mini.'],
            ['nama' => 'Pot painting + cactus', 'harga' => 68000, 'deskripsi' => 'Melukis pot sekaligus menanam kaktus mini sebagai kenang-kenangan ramah lingkungan.'],
        ];

        foreach ($kegiatanPainting as $painting) {
            KegiatanArtSpace::create([
                'nama' => $painting['nama'],
                'deskripsi' => $painting['deskripsi'],
                'harga' => $painting['harga'],
                'artspace_id'   => $paintingClass->id
            ]);
        }

        $funclayClass = ArtSpace::create(['nama' => 'Funclay Class']);
        $kegitanFunclay = [
            ['nama' => 'Air Dry Clay', 'harga' => 60000, 'deskripsi' => 'Membuat kreasi dari clay yang bisa mengering sendiri tanpa oven.'],
            ['nama' => 'Paint Clay', 'harga' => 70000, 'deskripsi' => 'Membentuk objek dari clay dan mewarnainya dengan cat.'],
            ['nama' => 'Diy Clay Painting', 'harga' => 90000, 'deskripsi' => 'Paket lengkap membuat dan melukis bentuk dari clay sesuai imajinasi.'],
            ['nama' => 'Frame sotf clay', 'harga' => 75000, 'deskripsi' => 'Menghias bingkai foto dengan clay warna-warni dan karakter lucu.'],
            ['nama' => 'Mirror soft clay', 'harga' => 75000, 'deskripsi' => 'Cermin dihias dengan bentuk clay lucu seperti bunga dan tokoh kartun.'],
        ];


        foreach ($kegitanFunclay as $funclay) {
            KegiatanArtSpace::create([
                'nama' => $funclay['nama'],
                'deskripsi' => $funclay['deskripsi'],
                'harga' => $funclay['harga'],
                'artspace_id'   => $funclayClass->id
            ]);
        }

        $beadsClass = ArtSpace::create(['nama' => 'Beads Class']);
        $kegiatanBeadClass = [
            ['nama' => 'Beads Cup kecil', 'harga' => 35000, 'deskripsi' => 'Membuat perhiasan sederhana dari manik-manik dengan ukuran cup kecil.'],
            ['nama' => 'Beads Cup Besar', 'harga' => 50000, 'deskripsi' => 'Lebih banyak pilihan manik-manik dalam cup besar untuk eksplorasi kreatif.'],
        ];


        foreach ($kegiatanBeadClass as $kegiatanBeadClass) {
            KegiatanArtSpace::create([
                'nama' => $kegiatanBeadClass['nama'],
                'deskripsi' => $kegiatanBeadClass['deskripsi'],
                'harga' => $kegiatanBeadClass['harga'],
                'artspace_id'   => $beadsClass->id
            ]);
        }

        $decoCreamClass = ArtSpace::create(['nama' => 'DIY Deco Cream']);
        $kegiatanDecoCream = [
            ['nama' => 'Mirror Deco Cream', 'harga' => 70000, 'deskripsi' => 'Menghias cermin mini dengan dekorasi krim imitasi warna-warni.'],
            ['nama' => 'Keychain Deco Cream', 'harga' => 25000, 'deskripsi' => 'Membuat gantungan kunci unik dengan dekorasi cream dan manik-manik.'],
            ['nama' => 'Frame Deco Cream', 'harga' => 75000, 'deskripsi' => 'Menghias bingkai foto dengan cream imitasi dan aksen lucu lainnya.'],
            ['nama' => 'Case Deco Cream', 'harga' => 75000, 'deskripsi' => 'Menghias casing HP dengan topping dekoratif bergaya dessert.'],
        ];

        foreach ($kegiatanDecoCream as $deco) {
            KegiatanArtSpace::create([
                'nama' => $deco['nama'],
                'deskripsi' => $deco['deskripsi'],
                'harga' => $deco['harga'],
                'artspace_id'   => $decoCreamClass->id
            ]);
        }
    }
}
