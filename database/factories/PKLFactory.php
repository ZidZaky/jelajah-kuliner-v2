<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

class PKLFactory extends Factory
{
    public function definition(): array
    {
        $picture = [
            'Esse tempor ipsa vo.png',
            'Qui autem doloribus.png',
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
