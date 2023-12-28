<?php

namespace App\Livewire\Admin\Reservations;

use App\Enums\AccommodationType;
use App\Enums\BookingStatus;
use App\Enums\TransactionStatus;
use App\Events\BookingHasBeenReserved;
use App\Models\Booking;
use App\Services\Sinch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewTransaction extends Component
{
    public ?Booking $booking = null;

    public string $identifier = 'view-transaction';

    #[On('view-transaction')]
    public function initialize(Booking $booking): void
    {
        $this->booking = $booking;
        $this->dispatch('open-dialog', identifier: $this->identifier);
    }

    public function confirm(Booking $booking): void
    {
        $booking->transaction->status = TransactionStatus::Approved;
        $booking->transaction->save();

        $booking->status = BookingStatus::Confirmed;
        $booking->save();

        if ($booking->accommodation->type === AccommodationType::Barbershop || $booking->accommodation->type === AccommodationType::Restobar) {
            $message = "You're booking for {$booking->accommodation->name} on " . Carbon::parse($booking->booking_date)->format('F d, Y') . " has been reserved." ;
        } else {
            $message = "You're booking for {$booking->accommodation->name} from " . Carbon::parse($booking->checkin_date)->format('F d, Y') . " to " . Carbon::parse($booking->checkout_date)->format('F d, Y') . " has been reserved.";
        }

        Sinch::send($message);

        event(new BookingHasBeenReserved($booking));

        $this->dispatch('close-dialog');


    }

    public function render()
    {
        return view('livewire.admin.reservations.view-transaction');
    }
}
