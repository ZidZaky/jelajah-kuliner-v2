<?php

namespace Database\Factories;

use App\Models\Pesanan;
use App\Models\Produk;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesanan>
 */
class PesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pesanan::class;

    public function definition(): array
    {
        return [
            'idAccount' => \App\Models\Account::factory(), // Misalnya Account factory sudah ada
            'idPKL' => \App\Models\PKL::factory(), // Misalnya PKL factory sudah ada
            'Keterangan' => $this->faker->sentence,
            'TotalBayar' => $this->faker->randomNumber(5),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }

    /**
     * After a Pesanan is created, attach related products.
     */
    public function configure()
    {
        return $this->afterCreating(function (Pesanan $pesanan) {
            // Pilih produk secara acak dan tambahkan ke pesanan
            $produkIds = Produk::inRandomOrder()->take(3)->pluck('id'); // Pilih 3 produk secara acak
            foreach ($produkIds as $produkId) {
                // Menambahkan produk yang dipesan ke dalam pesanan
                $pesanan->produks()->attach($produkId, [
                    'JumlahProduk' => $this->faker->numberBetween(1, 5), // Jumlah produk yang dipesan
                ]);
            }
        });
    }
}
