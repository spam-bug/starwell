<?php

namespace App\Events;

use App\Models\User as Staff;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StaffPasswordReset
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Staff $staff, public string $password)
    {

    }
}
