<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'booking_id',
        'gcash_reference_number',
        'gcash_receipt',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => TransactionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }

    public function amount(): string
    {
        return number_format(substr($this->amount, 0, -2) . '.' . substr($this->amount, -2), 2);
    }

    public function downPayment(): string
    {
        return number_format(substr($this->amount / 2, 0, -2) . '.' . substr($this->amount / 2, -2), 2);
    }
}
