<?php

namespace App\Listeners;

use App\Models\User as Staff;
use App\Notifications\Admin\PendingBooking;
use App\Notifications\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class SendBookingNotification
{
    public function handle(object $event): void
    {
        Notification::send(Staff::member()->get(), new PendingBooking($event->booking));

        Auth::user()->notify(new Booking($event->booking));
    }
}
