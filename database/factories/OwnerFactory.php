<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Owner> */
class OwnerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->randomElement(['Maria', 'Juan', 'Ana', 'Jose', 'Carla', 'Miguel', 'Liza', 'Paolo', 'Grace', 'Rico', 'Bea', 'Noel']),
            'last_name' => fake()->randomElement(['Santos', 'Reyes', 'Cruz', 'Garcia', 'Dela Cruz', 'Ramos', 'Mendoza', 'Bautista', 'Villanueva', 'Torres', 'Aquino', 'Flores']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '09'.fake()->numerify('#########'),
            'address' => 'Brgy. '.fake()->lastName().', Cebu City',
        ];
    }
}
