<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'name', 'notes', 'cost'];

    protected $casts = ['cost' => 'decimal:2'];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
