<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accommodation_id',
        'checkin_date',
        'checkout_date',
        'booking_date',
        'person_quantity',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => BookingStatus::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function scopePending(Builder $query): void
    {
        $query->whereIn('status', [BookingStatus::Pending, BookingStatus::ToPay]);
    }

    public function scopePaid(Builder $query): void
    {
        $query->where('status', BookingStatus::Paid);
    }

    public function scopeReserved(Builder $query): void
    {
        $query->where('status', BookingStatus::Confirmed);
    }

    public function scopeCancelled(Builder $query): void
    {
        $query->whereIn('status', [BookingStatus::CancelledByClient, BookingStatus::CancelledByHost, BookingStatus::CancelledBySystem]);
    }

    public function amount()
    {
        return "₱" . number_format(substr($this->amount, 0, -2) . '.' . substr($this->amount, -2), 2);
    }

    public function downPayment()
    {
        return "₱" . number_format(substr($this->amount / 2, 0, -2) . '.' . substr($this->amount / 2, -2), 2);
    }
}
