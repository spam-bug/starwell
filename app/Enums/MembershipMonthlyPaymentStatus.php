<?php

namespace App\Enums;

enum MembershipMonthlyPaymentStatus: string
{
    case toPay = 'to_pay';
    case verifying = 'verifying';
    case paid = 'paid';
}
