<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Pet> */
class PetFactory extends Factory
{
    public function definition(): array
    {
        $breeds = [
            'Dog' => ['Aspin', 'Shih Tzu', 'Labrador', 'Golden Retriever', 'Pug', 'Beagle'],
            'Cat' => ['Puspin', 'Persian', 'Siamese', 'British Shorthair'],
            'Bird' => ['Lovebird', 'Cockatiel', 'Parakeet'],
            'Rabbit' => ['Holland Lop', 'Mini Rex'],
            'Hamster' => ['Syrian', 'Dwarf'],
        ];
        $species = fake()->randomElement(array_keys($breeds));
        $weight = ['Dog' => [3, 35], 'Cat' => [2, 7], 'Bird' => [0.03, 0.4], 'Rabbit' => [1, 3], 'Hamster' => [0.03, 0.2]][$species];

        return [
            'owner_id' => Owner::query()->inRandomOrder()->value('id') ?? Owner::factory(),
            'name' => fake()->randomElement(['Bantay', 'Mingming', 'Choco', 'Luna', 'Max', 'Bella', 'Kiko', 'Mochi', 'Coco', 'Bruno', 'Nala', 'Oreo', 'Peanut', 'Simba']),
            'species' => $species,
            'breed' => fake()->randomElement($breeds[$species]),
            'sex' => fake()->randomElement(['Male', 'Female']),
            'birth_date' => fake()->dateTimeBetween('-10 years', '-3 months')->format('Y-m-d'),
            'weight_kg' => round(fake()->randomFloat(2, $weight[0], $weight[1]), 2),
        ];
    }
}
