<?php

namespace App\Livewire\Customer;

use App\Models\Booking;
use Livewire\Component;
use App\Models\Membership;
use App\Enums\BookingStatus;
use App\Enums\MembershipStatus;
use App\Enums\AccommodationType;
use App\Enums\AccommodationStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Enums\MembershipMonthlyPaymentStatus;

class SubscriptionDataTable extends Component
{
    public string $status = 'active';

    protected $listeners = ['refresh' => '$refresh'];

    public function cancel(int $id): void
    {
        $membership = Membership::find($id);

        $membership->status = MembershipStatus::cancelled;

        $membership->save();
    }

    public function resubcribe($id)
    {
        $membership = Membership::find($id);
        
        $membership->status = MembershipStatus::ongoing;

        $sevenDaysFromNow = now()->addDays(7);

        if ($membership->end_date < $sevenDaysFromNow) {
            $membership->monthly_payment_status = MembershipMonthlyPaymentStatus::toPay;
        }

        $membership->save();
    }

    public function render(): View
    {
        return view('livewire.customer.subscription-data-table', [
        'subscriptions' => Auth::user()->memberships()
            ->when($this->status === 'active', function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('status', [MembershipStatus::ongoing, MembershipStatus::pending])
                        ->orWhere(function ($query) {
                            $query->where('status', MembershipStatus::cancelled)
                                ->where('end_date', '>', now()); // Add the condition for not reaching end date
                        });
                });
            })
            ->when($this->status === 'ongoing', function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('status', [MembershipStatus::ongoing])
                        ->orWhere(function ($query) {
                            $query->where('status', MembershipStatus::cancelled)
                                ->where('end_date', '>', now()); // Add the condition for not reaching end date
                        });
                });
            })
            ->when($this->status === 'cancelled',  function ($query) {
                $query->where('status', MembershipStatus::cancelled);
            })
            ->get(),
        ]);
    }
}
