<?php

namespace App\Livewire\Admin\Reservations;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Enums\BookingStatus;
use App\Events\ConfirmedBooking;
use App\Models\Booking;
use App\Services\Sinch;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin'), Title('Pending Reservations')]
class PendingDataTable extends Component
{
    public function confirm(int $id): void
    {
        $booking = Booking::find($id);
        $booking->status = BookingStatus::ToPay;

        $booking->save();

        event(new ConfirmedBooking($booking));

        $this->dispatch('toast', message: 'Booking has been confirmed');
    }

    public function cancel(int $id): void
    {
        $booking = Booking::find($id);
        $booking->status = BookingStatus::CancelledByHost;

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
        return view('livewire.admin.reservations.pending-data-table', [
            'reservations' => Booking::pending()->get(),
        ]);
    }
}
