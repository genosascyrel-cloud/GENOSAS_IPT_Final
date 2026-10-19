<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /** Only completed appointments receive treatments. */
    public function run(): void
    {
        Appointment::where('status', 'Completed')->get()->each(function (Appointment $appointment) {
            Treatment::factory()->count(fake()->numberBetween(1, 3))->create(['appointment_id' => $appointment->id]);
        });
    }
}
