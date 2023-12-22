<?php

namespace App\Livewire\Customer;

use App\Enums\BookingStatus;
use App\Enums\TransactionStatus;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Payment extends Component
{
    use WithFileUploads;

    public ?Booking $booking = null;
    public string $identifier = 'payment';

    public $referenceNumber = '';
    public $receipt = '';

    #[On('payment')]
    public function initialize(Booking $booking): void
    {
        $this->reset();

        $this->booking = $booking;

        $this->dispatch('open-dialog', identifier: $this->identifier);
    }

    public function confirm(): void
    {
        $this->validate([
          'referenceNumber' => [Rule::requiredIf(empty($this->receipt))],
          'receipt' => [Rule::requiredIf(empty($this->referenceNumber))],
        ]);

        $path = null;

        if ($this->receipt instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $path = $this->receipt->store('photos');
        }

        $this->booking->transaction()->create([
            'user_id' => Auth::id(),
            'gcash_reference_number' => $this->referenceNumber,
            'gcash_receipt' => $path,
            'amount' => $this->booking->amount,
            'status' => TransactionStatus::Pending,
        ]);

        $this->booking->status = BookingStatus::Paid;
        $this->booking->save();

        $this->dispatch('close-dialog');
        $this->dispatch('toast', message: "Payment Success");
        $this->dispatch('refresh');

        $this->reset();
    }
}
