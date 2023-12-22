<?php

namespace App\Listeners;

use App\Notifications\StaffPasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStaffPasswordResetNotification
{
    public function handle(object $event): void
    {
        $event->staff->notify(new StaffPasswordReset($event->password));
    }
}
