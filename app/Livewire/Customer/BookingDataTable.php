<?php

namespace App\Livewire\Customer;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingDataTable extends Component
{
    public string $status = 'active';

    protected $listeners = ['refresh' => '$refresh'];

    public function cancel(int $id): void
    {
        $booking = Booking::find($id);

        $booking->status = BookingStatus::CancelledByClient;

        if ($booking->accommodation->type === AccommodationType::Resort || $booking->accommodation->type === AccommodationType::Restobar) {
            $booking->accommodation->status = AccommodationStatus::available;
            $booking->accommodation->save();
        }

        if ($booking->accommodation->status === AccommodationType::Barbershop) {
            $booking->accommodation->available_slots += $booking->person_quantity;

            if ($booking->accommodation->status === AccommodationStatus::unavailable) {
                $booking->accommodation->status = AccommodationStatus::available;
            }

            $booking->accommodation->save();
        }

        $booking->save();
    }

    public function render(): View
    {
        $statuses = [];

        if ($this->status === 'active') {
            $statuses = [BookingStatus::Pending, BookingStatus::ToPay, BookingStatus::Paid, BookingStatus::Confirmed];
        }

        if ($this->status === 'completed') {
            $statuses = [BookingStatus::Completed];
        }

        if ($this->status === 'cancelled') {
            $statuses = [BookingStatus::CancelledByClient, BookingStatus::CancelledByHost, BookingStatus::CancelledBySystem];
        }

        return view('livewire.customer.booking-data-table', [
            'bookings' => Auth::user()->bookings()->whereIn('status', $statuses)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
