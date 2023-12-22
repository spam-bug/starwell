<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeMember(Builder $query): void
    {
        $query->whereIn('account_type', ['admin', 'staff']);
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

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
