<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

class PKLFactory extends Factory
{
    public function definition(): array
    {
        $picture = [
            '943eef047095917b7e4ee41f2d4aba19.jpg',
            'c14aa7263951b3f5ec8007380bcd81c0.jpg',
        ];
        return [
            'idAccount' => Account::factory(),
            'namaPKL' => $this->faker->company,
            'desc' => $this->faker->paragraph,
            'picture' => 'pkl/' . $this->faker->randomElement($picture),
            'latitude' => $this->faker->randomFloat(8, -7.4, -7.2),
            'longitude' => $this->faker->randomFloat(8, 112.6, 112.8),
        ];
    }
}
