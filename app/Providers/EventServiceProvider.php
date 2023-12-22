<?php

namespace App\Providers;

use App\Events\Booking;
use App\Events\BookingHasBeenReserved;
use App\Events\ConfirmedBooking;
use App\Events\DefaultPassword;
use App\Events\StaffPasswordReset;
use App\Listeners\SendBookingHasBeenReservedNotification;
use App\Listeners\SendBookingNotification;
use App\Listeners\SendConfirmedBookingNotification;
use App\Listeners\SendDefaultPasswordNotification;
use App\Listeners\SendStaffPasswordResetNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DefaultPassword::class => [
            SendDefaultPasswordNotification::class,
        ],
        StaffPasswordReset::class => [
            SendStaffPasswordResetNotification::class,
        ],
        Booking::class => [
            SendBookingNotification::class,
        ],
        ConfirmedBooking::class => [
            SendConfirmedBookingNotification::class,
        ],
        BookingHasBeenReserved::class => [
            SendBookingHasBeenReservedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
