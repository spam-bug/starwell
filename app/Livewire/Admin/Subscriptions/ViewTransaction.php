<?php

namespace App\Livewire\Admin\Subscriptions;

use App\Enums\MembershipMonthlyPaymentStatus;
use App\Enums\MembershipStatus;
use App\Enums\TransactionStatus;
use App\Models\Membership;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewTransaction extends Component
{
    public ?Membership $membership = null;
    public ?Transaction $transaction = null;

    public string $identifier = 'view-transaction';

    public function mount()
    {
        $this->transaction = new Transaction;
    }

    #[On('view-transaction')]
    public function initialize(Membership $membership): void
    {
        $this->membership = $membership;

        $this->transaction = $membership->transactions()->where('status', TransactionStatus::Pending)->first();

        $this->dispatch('open-dialog', identifier: $this->identifier);
    }

    public function confirm()
    {
        $this->transaction->status = TransactionStatus::Approved;
        $this->transaction->save();

        $this->membership->monthly_payment_status = MembershipMonthlyPaymentStatus::paid;
        $this->membership->status = MembershipStatus::ongoing;

        if (is_null($this->membership->start_date)) {
            $this->membership->start_date = now();
            $this->membership->end_date = now()->addMonth();
        } else {
            $this->membership->end_date = Carbon::parse($this->membership->end_date)->addMonth();
        }

        $this->membership->save();

        $this->dispatch('close-dialog');
    }

    public function render()
    {
        return view('livewire.admin.subscriptions.view-transaction');
    }
}
