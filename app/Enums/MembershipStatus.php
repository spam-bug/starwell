<?php

namespace App\Enums;

enum MembershipStatus: string
{
    case ongoing = 'ongoing';
    case ended = 'ended';
    case pending = 'pending';
}
