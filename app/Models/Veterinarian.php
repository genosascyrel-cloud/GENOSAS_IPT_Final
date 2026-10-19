<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Veterinarian extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'specialization', 'license_number', 'phone', 'email'];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
