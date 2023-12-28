<?php

namespace App\Models;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
        'max_person',
        'max_daily_capacity',
        'status',
        'photo'
    ];

    protected $casts = [
        'status' => AccommodationStatus::class,
        'type' => AccommodationType::class,
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function price(): string
    {
        return "₱" . number_format(substr($this->price, 0, -2) . '.' . substr($this->price, -2), 2);
    }
}
