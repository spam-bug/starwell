<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Enums\MembershipStatus;
use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'total' => [
                'bookings' => Booking::where('status', BookingStatus::Confirmed)->count(),
                'membership' => Membership::where('status', MembershipStatus::ongoing)->count(),
                'transactions' => Transaction::where('status', TransactionStatus::Approved)->sum('amount'),
                'monthly' => Transaction::whereMonth('created_at', today())->where('status', TransactionStatus::Approved)->sum('amount'),
            ],
            'bookings' => Booking::where('status', BookingStatus::Confirmed)->get(),
            'memberships' => Membership::where('status', MembershipStatus::ongoing)->get(),
        ]);
    }
}
