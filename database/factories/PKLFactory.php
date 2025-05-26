<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

class PKLFactory extends Factory
{
    public function definition(): array
    {
        $picture=[
            'Pentol.jpg',
            'Seblak.png',
        ];
        return [
            'idAccount' => Account::factory(),
            'namaPKL' => $this->faker->company,
            'desc' => $this->faker->paragraph,
            'picture' => $this->faker->randomElement($picture),
            'longitude' => $this->faker->randomFloat(8, -180, 180),
            'latitude' => $this->faker->randomFloat(8, -90, 90),
        ];
    }
}
