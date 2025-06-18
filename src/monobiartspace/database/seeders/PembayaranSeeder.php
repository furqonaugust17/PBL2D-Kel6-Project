<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PembayaranBooking;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        User::factory()->count(10)->create();
        $userIds = User::pluck('id')->toArray();

        Customer::factory()->count(10)->create([
            'user_id' => $faker->randomElement($userIds)
        ]);
        $customerIds = Customer::pluck('id')->toArray();

        foreach (range(1, 20) as $i) {
            $type = $faker->randomElement(['artspace', 'kids']);
            $customerId = $faker->randomElement($customerIds);
            $nominal = $faker->numberBetween(100000, 500000);
            $diskon = $faker->numberBetween(0, 50000);
            $tanggalReservasi = $faker->dateTimeBetween('+1 days', '+1 month');
            $status = $faker->randomElement(['menunggu pembayaran', 'menunggu kedatangan', 'datang', 'ajukan batal', 'batal']);

            $pendaftaran = Pendaftaran::create([
                'type' => $type,
                'customer_id' => $customerId,
                'nominal' => $nominal,
                'diskon' => $diskon,
                'tanggal_reservasi' => $tanggalReservasi,
                'status' => $status,
            ]);

            PembayaranBooking::create([
                'order_id' => strtoupper(Str::random(10)),
                'pendaftaran_id' => $pendaftaran->id,
                'payment_date' => $faker->dateTimeBetween($tanggalReservasi->format('Y-m-d') . ' -5 days', $tanggalReservasi->format('Y-m-d')),
                'amount' => $nominal - $diskon,
                'payment_method' => $faker->randomElement(['qris', 'transfer', 'cash']),
                'status' => $faker->randomElement(['success', 'pending', 'expired']),
                'snap_token' => Str::random(30),
                'snap_url' => $faker->url,
            ]);
        }
    }
}
