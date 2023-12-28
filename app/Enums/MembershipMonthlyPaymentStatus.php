<?php

namespace App\Enums;

enum MembershipMonthlyPaymentStatus: string
{
    case toPay = 'to_pay';
    case verifying = 'verifying';
    case paid = 'paid';

    public function getStatusClass(): string
    {
        return match($this) {
            self::toPay => 'bg-gray-900 text-white',
            self::verifying => 'bg-blue-100 text-blue-800',
            self::paid => 'bg-green-100 text-green-800',
        };
    }
}
