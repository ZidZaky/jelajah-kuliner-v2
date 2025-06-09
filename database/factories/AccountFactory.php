<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    public function definition(): array
    {
        $foto=[
            'evi.jpg',
            'dika.png',
        ];
        $status = ['PKL','Pelanggan'];
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nohp' => $this->faker->phoneNumber(),
            'password' => Hash::make('pwCuy'), // default password
            'status' => $this->faker->randomElement($status),
            'foto' => $this->faker->randomElement($foto),
        ];
    }
}
