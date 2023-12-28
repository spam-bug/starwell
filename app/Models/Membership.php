<?php

namespace App\Models;

use App\Enums\MembershipMonthlyPaymentStatus;
use App\Enums\MembershipStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
