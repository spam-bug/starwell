<?php

namespace App\Livewire;

use App\Enums\AccommodationType;
use App\Enums\BookingStatus;
use App\Enums\MembershipMonthlyPaymentStatus;
use App\Enums\MembershipStatus;
use App\Events\Booking;
use App\Models\Accommodation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingAndMembershipForm extends Component
{
    public Accommodation $accommodation;
    public $checkinDate = '';
    public $checkoutDate = '';
    public $bookingDate = '';
    public $personQuantity = '';

    public function mount(Accommodation $accommodation): void
    {
        $this->accommodation = $accommodation;
    }

    public function book(): void
    {
        switch ($this->accommodation->type) {
            case AccommodationType::Resort:
                $this->bookResort();
                break;

            case AccommodationType::Restobar:
                $this->bookRestobar();
                break;

            case AccommodationType::Barbershop:
                $this->bookBarbershop();
                break;

            default:
                $this->dispatch('toast', message: "Unsupported accommodation type");
                break;
        }
    }

    public function join(): Void
    {
        if (Auth::user()->memberships->where('accommodation_id', $this->accommodation->id)->whereIn('status', [MembershipStatus::pending, MembershipStatus::ongoing])->count()) {
            $this->dispatch('toast', message: "You have an active membership");
            return;
        }

        Auth::user()->memberships()->create([
            'accommodation_id' => $this->accommodation->id,
            'status' => MembershipStatus::pending,
            'monthly_payment_status' => MembershipMonthlyPaymentStatus::toPay,
        ]);
    }

    private function bookResort(): void
    {
        $bookings = $this->accommodation->bookings()->whereBetween('checkin_date', [$this->checkinDate, $this->checkoutDate])
            ->orWhereBetween('checkout_date', [$this->checkinDate, $this->checkoutDate])
            ->orWhere(function ($query) {
                $query->where('checkin_date', '<=', $this->checkinDate)
                    ->where('checkout_date', '>=', $this->checkoutDate);
            })->get();

        if ($bookings->isNotEmpty()) {
            // Dates are not available, handle accordingly
            $this->dispatch('toast', message: "Selected dates are not available");
            return;
        }

        $booking = Auth::user()->bookings()->create([
            'accommodation_id' => $this->accommodation->id,
            'checkin_date' => $this->checkinDate,
            'checkout_date' => $this->checkoutDate,
            'person_quantity' => $this->personQuantity,
            'amount' => $this->accommodation->price,
            'status' => BookingStatus::Pending,
        ]);

        event(new Booking($booking));
        $this->dispatch('toast', message: "Booking successful");
    }

    private function bookRestobar(): void
    {
        $existingBooking = $this->accommodation->bookings()->where('booking_date', $this->bookingDate)->first();

        if ($existingBooking) {
            // Date is not available, handle accordingly
            $this->dispatch('toast', message: "Selected date is not available for Restobar");
            return;
        }

        $booking = Auth::user()->bookings()->create([
            'accommodation_id' => $this->accommodation->id,
            'booking_date' => $this->bookingDate,
            'person_quantity' => $this->personQuantity,
            'amount' => $this->accommodation->price,
            'status' => BookingStatus::Pending,
        ]);

        event(new Booking($booking));
        $this->dispatch('toast', message: "Booking successful for Restobar");
    }

    private function bookBarbershop(): void
    {
        $bookings = $this->accommodation->bookings()->where('booking_date', $this->bookingDate)->get();

        $bookingCount = 0;

        foreach ($bookings as $booking) {
            $bookingCount += $booking->person_quantity;
        }

        if ($bookingCount === $this->accommodation->max_daily_capacity) {
            $this->dispatch('toast', message: "No more available slot for this date.");
            return;
        }

        $booking = Auth::user()->bookings()->create([
            'accommodation_id' => $this->accommodation->id,
            'booking_date' => $this->bookingDate,
            'person_quantity' => $this->personQuantity,
            'amount' => $this->accommodation->price *  $this->personQuantity,
            'status' => BookingStatus::Pending,
        ]);
    }
}