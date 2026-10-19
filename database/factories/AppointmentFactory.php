<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Appointment> */
class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-2 months', '+1 month')
            ->setTime(fake()->numberBetween(8, 16), fake()->randomElement([0, 30]));
        $past = $date < now();

        return [
            'pet_id' => Pet::query()->inRandomOrder()->value('id') ?? Pet::factory(),
            'veterinarian_id' => Veterinarian::query()->inRandomOrder()->value('id') ?? Veterinarian::factory(),
            'appointment_date' => $date,
            'reason' => fake()->randomElement(['Annual check-up', 'Vaccination', 'Skin allergy', 'Dental cleaning', 'Limping', 'Deworming', 'Spay/Neuter', 'Loss of appetite']),
            'status' => $past ? fake()->randomElement(['Completed', 'Completed', 'Completed', 'Cancelled']) : 'Scheduled',
            'notes' => fake()->boolean(40) ? fake()->sentence() : null,
        ];
    }
}
