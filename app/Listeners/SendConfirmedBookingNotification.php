<?php

namespace App\Listeners;

use App\Models\User as Staff;
use Illuminate\Support\Facades\Notification;

class SendConfirmedBookingNotification
{

    public function handle(object $event): void
    {
        Notification::send(Staff::member()->get(), new \App\Notifications\Admin\ConfirmedBooking($event->booking));

        $event->booking->client->notify(new \App\Notifications\ConfirmedBooking($event->booking));
    }
}
