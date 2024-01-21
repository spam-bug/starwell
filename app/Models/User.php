<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\MembershipStatus;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'account_type',
        'contact_number',
        'address',
        'birthday'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    public function scopeMember(Builder $query): void
    {
        $query->whereIn('account_type', ['admin', 'staff']);
    }

    public function activeMembershipFor(Accommodation $accommodation): bool
    {
        return $this->memberships()
            ->where('accommodation_id', $accommodation->id)->whereIn('status', [MembershipStatus::pending, MembershipStatus::ongoing])
            ->exists();
    }

    public function membershipStatusFor(Accommodation $accommodation): string
    {
        return $this->memberships()->where('accommodation_id', $accommodation->id)
        ->whereIn('status', [MembershipStatus::pending, MembershipStatus::ongoing])
        ->first()->status->value;
    }

    public function isCustomer(): bool
    {
        return $this->account_type === 'customer';
    }

    public function isStaff(): bool
    {
        return $this->account_type ==='staff';
    }

    public function isAdmin(): bool
    {
        return $this->account_type === 'admin';
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }
}
