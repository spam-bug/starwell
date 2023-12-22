<?php

namespace App\Listeners;

use App\Notifications\DefaultPassword;

class SendDefaultPasswordNotification
{

    public function handle(object $event): void
    {
        $event->staff->notify(new DefaultPassword($event->password));
    }
}
