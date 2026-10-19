<?php

namespace Database\Factories;

use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Veterinarian> */
class VeterinarianFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Dr. '.fake()->name(),
            'specialization' => fake()->randomElement(['General Practice', 'Surgery', 'Dermatology', 'Dentistry', 'Exotic Animals']),
            'license_number' => 'VET-'.fake()->unique()->numerify('######'),
            'phone' => '09'.fake()->numerify('#########'),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
