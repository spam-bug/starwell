<?php

namespace App\Models;

use App\Enums\MembershipMonthlyPaymentStatus;
use App\Enums\MembershipStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'start_date',
        'end_date',
        'status',
        'monthly_payment_status'
    ];

    protected $casts = [
        'status' => MembershipStatus::class,
        'monthly_payment_status' => MembershipMonthlyPaymentStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopePending(Builder $query): void
    {
        $query->whereIn('monthly_payment_status', [MembershipMonthlyPaymentStatus::toPay, MembershipMonthlyPaymentStatus::verifying])
            ->where('status', '!=', MembershipStatus::cancelled);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', MembershipStatus::ongoing);
    }

    public function scopeCancelled(Builder $query): void
    {
        $query->whereIn('status', [MembershipStatus::cancelled, MembershipStatus::ended]);
    }
}
