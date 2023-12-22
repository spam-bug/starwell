<?php

namespace App\Enums;

enum BookingStatus: string
{
    /**
     * Booking has been made by the customer
     */
    case Pending = 'pending';

    /**
     * Booking has been confirmed by the staff and is currently
     * in the process of payment.
     */
    case ToPay = 'to_pay';

    /**
     * Booking has been paid by the customer and is currently waiting for confirmation.
     */
    case Paid = 'paid';

    /**
     * Payment has been confirmed by the staff and the booking has been reserved.
     */
    case Confirmed = 'confirmed';

    /**
     * Booking has been cancelled by the client and might need refunding.
     */
    case CancelledByClient = 'cancelled_by_client';

    /**
     * Booking has been cancelled by the host because of possible
     * reservation conflicts.
     */
    case CancelledByHost = 'cancelled_by_host';

    /**
     * Booking has been cancelled by the system because the
     * no action has been made and the check in date has lapsed.
     */
    case CancelledBySystem = 'cancelled_by_system';

    /**
     * Booking has been completed and has been reserved.
     */
    case Completed = 'completed';

    public function getStatusClass(): string
    {
        return match($this) {
            self::Pending => 'bg-gray-900 text-white',
            self::ToPay, self::Paid => 'bg-blue-100 text-blue-800',
            self::Confirmed => 'bg-green-100 text-green-800',
            self::CancelledByClient, self::CancelledByHost, self::CancelledBySystem => 'bg-red-100 text-red-800',
        };
    }
}
