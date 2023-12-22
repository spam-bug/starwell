<?php

namespace App\Livewire;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Enums\BookingStatus;
use App\Events\Booking;
use App\Models\Accommodation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BookingForm extends Component
{
    public ?Accommodation $accommodation = null;
    public string $identifier = 'booking-form';

    #[Rule('required|date')]
    public $checkIn = '';

    #[Rule('required|date|after_or_equal:checkIn')]
    public $checkOut = '';

    #[Rule('required|min:1|lte:availableSlots')]
    public $personQuantity = '';

    public $availableSlots;

    protected $messages = [
        'personQuantity.lte' => 'The :attribute should not exceed the max person allowed.',
    ];

    #[On('book')]
    public function book(Accommodation $accommodation): void
    {
        $this->reset();
        $this->accommodation = $accommodation;

        $this->availableSlots = $accommodation->available_slots;

        $this->dispatch('open-dialog', identifier: $this->identifier);
    }

    public function confirm(): void
    {
        $this->validate();

        $booking = Auth::user()->bookings()->create([
            'accommodation_id' => $this->accommodation->id,
            'check_in' => $this->checkIn,
            'check_out' => $this->checkOut,
            'person_quantity' => $this->personQuantity,
            'amount' => $this->accommodation->type === AccommodationType::Barbershop ? $this->accommodation->price * $this->personQuantity : $this->accommodation->price,
            'status' => BookingStatus::Pending,
        ]);

        if ($this->accommodation->type === AccommodationType::Resort || $this->accommodation->type === AccommodationType::Restobar) {
            $this->accommodation->status = AccommodationStatus::unavailable;
        }

        if ($this->accommodation->type === AccommodationType::Barbershop) {
            $availableSlots = $this->availableSlots - $this->personQuantity;
            $this->accommodation->available_slots = $availableSlots;

            if ($availableSlots === 0) {
                $this->accommodation->status = AccommodationStatus::unavailable;
            }
        }

        $this->accommodation->save();

        event(new Booking($booking));

        $this->dispatch('close-dialog');
        $this->dispatch('refresh');
        $this->dispatch('open-dialog', identifier: 'booking-success');
    }
}
