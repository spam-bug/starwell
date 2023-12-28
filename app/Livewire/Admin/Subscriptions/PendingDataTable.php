<?php

namespace App\Livewire\Admin\Subscriptions;

use App\Enums\MembershipStatus;
use App\Models\Membership;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin'), Title('Pending Subscriptions')]
class PendingDataTable extends Component
{
    public function cancel($id)
    {
        $membership = Membership::find($id);
        $membership->status = MembershipStatus::cancelled;
        $membership->save();
    }

    public function render()
    {
        return view('livewire.admin.subscriptions.pending-data-table', [
            'subscriptions' => Membership::pending()->get(),
        ]);
    }
}
