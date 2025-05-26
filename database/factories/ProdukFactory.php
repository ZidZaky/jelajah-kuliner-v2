<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PKL;

class ProdukFactory extends Factory
{
    public function definition(): array
    {
        return [
            'namaProduk' => $this->faker->word,
            'desc' => $this->faker->paragraph,
            'harga' => $this->faker->numberBetween(10000, 50000),
            'stokAktif' => null,
            'jenisProduk' => $this->faker->randomElement(['makanan', 'minuman']),
            'fotoProduk' =>  $this->faker->imageUrl(640, 480, 'food', true), 
            'idPKL' => \App\Models\PKL::factory(), // Hubungkan dengan factory PKL
        ];
    }
}
