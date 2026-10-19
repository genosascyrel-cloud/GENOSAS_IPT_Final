<?php

namespace Database\Seeders;

use App\Models\Veterinarian;
use Illuminate\Database\Seeder;

class VeterinarianSeeder extends Seeder
{
    public function run(): void
    {
        Veterinarian::factory()->count(5)->create();
    }
}
