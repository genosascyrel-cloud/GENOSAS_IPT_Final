<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Treatment> */
class TreatmentFactory extends Factory
{
    public function definition(): array
    {
        $options = [
            'Consultation' => 350, 'Anti-rabies Vaccine' => 450, '5-in-1 Vaccine' => 650,
            'Deworming' => 250, 'Flea & Tick Treatment' => 500, 'Dental Scaling' => 1800,
            'Antibiotic Course' => 700, 'Skin Medication' => 600, 'Blood Test' => 1200,
        ];
        $name = fake()->randomElement(array_keys($options));

        return [
            'appointment_id' => Appointment::query()->inRandomOrder()->value('id') ?? Appointment::factory(),
            'name' => $name,
            'notes' => fake()->boolean(50) ? fake()->sentence() : null,
            'cost' => $options[$name],
        ];
    }
}
