<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    public const STATUSES = ['Scheduled', 'Completed', 'Cancelled'];
    public const STATUS_COLORS = ['Scheduled' => 'primary', 'Completed' => 'success', 'Cancelled' => 'secondary'];

    protected $fillable = ['pet_id', 'veterinarian_id', 'appointment_date', 'reason', 'status', 'notes'];

    protected $casts = ['appointment_date' => 'datetime'];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function veterinarian(): BelongsTo
    {
        return $this->belongsTo(Veterinarian::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
