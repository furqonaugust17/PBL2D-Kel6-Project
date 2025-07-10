<?php

namespace Database\Seeders;

use App\Models\Diskon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diskons = [
            [
                'nama' => 'Diskon Tahun Ajaran Baru',
                'diskon' => 15,
                'code' => 'TAHUNAJAR15',
                'expired_date' => Carbon::now()->addDays(15),
            ],
            [
                'nama' => 'Promo Ulang Tahun',
                'diskon' => 20,
                'code' => 'HBD20',
                'expired_date' => Carbon::now()->addMonth(),
            ],
            [
                'nama' => 'Diskon Early Bird',
                'diskon' => 10,
                'code' => 'EARLY10',
                'expired_date' => Carbon::now()->addWeeks(2),
            ],
            [
                'nama' => 'Diskon Spesial Akhir Tahun',
                'diskon' => 25,
                'code' => 'AKHIRTAHUN25',
                'expired_date' => Carbon::now()->endOfYear(),
            ],
        ];

        foreach ($diskons as $diskon) {
            Diskon::create($diskon);
        }
    }
}
