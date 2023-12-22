<?php

namespace App\Listeners;

use App\Models\User as Staff;

use Illuminate\Support\Facades\Notification;

class SendBookingHasBeenReservedNotification
{
    public function handle(object $event): void
    {
        Notification::send(Staff::member()->get(), new \App\Notifications\Admin\BookingHasBeenReserved($event->booking));

        $event->booking->client->notify(new \App\Notifications\BookingHasBeenReserved($event->booking));
    }
}
