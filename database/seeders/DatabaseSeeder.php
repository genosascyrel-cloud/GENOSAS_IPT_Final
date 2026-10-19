<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Parent tables first so every foreign key points to an existing row. */
    public function run(): void
    {
        $this->call([
            OwnerSeeder::class,
            VeterinarianSeeder::class,
            PetSeeder::class,
            AppointmentSeeder::class,
            TreatmentSeeder::class,
        ]);
    }
}
