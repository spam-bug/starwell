<?php

namespace App\Enums;

enum AccommodationStatus: string
{
    case available = 'available';
    case unavailable = 'unavailable';

    public function getStatusClass(): string
    {
        return match($this) {
            self::available => 'bg-green-100 text-green-800',
            self::unavailable => 'bg-red-100 text-red-800',
        };
    }
}
