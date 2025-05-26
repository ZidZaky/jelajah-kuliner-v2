<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ulasan;
use App\Models\Account;
use App\Models\PKL;
use Faker\Generator as Faker;
class UlasanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ulasan' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 5), // Rating antara 1 dan 5
            'idAccount' => Account::factory(), // Menghubungkan dengan Account
            'idPKL' => PKL::factory(), // Menghubungkan dengan PKL
        ];
    }
}
