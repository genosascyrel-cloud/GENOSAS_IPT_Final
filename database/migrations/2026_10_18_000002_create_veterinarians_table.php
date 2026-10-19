<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veterinarians', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('specialization', 100);
            $table->string('license_number', 30)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinarians');
    }
};
