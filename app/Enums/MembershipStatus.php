<?php

namespace App\Enums;

enum MembershipStatus: string
{
    case ongoing = 'ongoing';
    case ended = 'ended';
    case cancelled = 'cancelled';
    case pending = 'pending';

    public function getStatusClass(): string
    {
        return match($this) {
            self::pending => 'bg-gray-900 text-white',
            self::ongoing => 'bg-blue-100 text-blue-800',
            self::ended, self::cancelled => 'bg-red-100 text-red-800',
        };
    }
}
