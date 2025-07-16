<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventaris>
 */
class InventarisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => $this->faker->word(),
            'kategori' => $this->faker->randomElement(['Alat Lukis', 'Clay', 'Charm', 'Aksesoris']),
            'jumlah_stok_awal' => $this->faker->numberBetween(1, 100),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
