<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Bank BI',
                'phone' => '02112345678',
                'email' => 'contact@bankbi.co.id',
                'image' => 'uploads/partner/default/bank-bi.png',
                'description' => 'Bank Indonesia sebagai mitra strategis dalam mendukung program keuangan.',
            ],
            [
                'name' => 'Brand No Brand',
                'phone' => '081234567899',
                'email' => 'info@nobrand.co.id',
                'image' => 'uploads/partner/default/brand-no-brand.png',
                'description' => 'Brand tanpa identitas yang tetap berkontribusi dalam kegiatan seni dan sosial.',
            ],
            [
                'name' => 'Emina',
                'phone' => '082211334455',
                'email' => 'support@emina.co.id',
                'image' => 'uploads/partner/default/emina.png',
                'description' => 'Emina, produk kosmetik yang fun dan friendly bagi remaja masa kini.',
            ],
            [
                'name' => 'Make Over',
                'phone' => '085566778899',
                'email' => 'hello@makeover.co.id',
                'image' => 'uploads/partner/default/makeover.png',
                'description' => 'Make Over, partner utama untuk produk kecantikan dan makeover kreatif.',
            ],
            [
                'name' => 'Paragon',
                'phone' => '081212345678',
                'email' => 'partner@paragon.id',
                'image' => 'uploads/partner/default/paragon.png',
                'description' => 'Paragon Technology and Innovation, pelopor industri kosmetik Indonesia.',
            ],
            [
                'name' => 'Vivi Zubedi',
                'phone' => '08999887766',
                'email' => 'contact@vivizubedi.com',
                'image' => 'uploads/partner/default/vivi-zubedi.png',
                'description' => 'Desainer modest fashion ternama yang mendukung kreativitas anak bangsa.',
            ],
            [
                'name' => 'Wardah',
                'phone' => '081822233344',
                'email' => 'cs@wardahbeauty.com',
                'image' => 'uploads/partner/default/wardah.png',
                'description' => 'Wardah Beauty, produk halal kosmetik yang mendukung berbagai kegiatan positif.',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
