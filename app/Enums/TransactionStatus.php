<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case  Pending = "pending";
    case  Approved = "approved";

    public function getStatusClass(): string
    {
        return match($this) {
            self::Pending => 'bg-gray-900 text-white',
            self::Approved => 'bg-blue-100 text-blue-800',
        };
    }
}
