<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory;

    public const SPECIES = ['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster', 'Other'];

    protected $fillable = ['owner_id', 'name', 'species', 'breed', 'sex', 'birth_date', 'weight_kg'];

    protected $casts = ['birth_date' => 'date', 'weight_kg' => 'decimal:2'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
