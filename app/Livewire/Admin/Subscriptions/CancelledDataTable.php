<?php

namespace App\Livewire\Admin\Subscriptions;

use App\Models\Membership;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin'), Title('Cancelled Subscriptions')]
class CancelledDataTable extends Component
{
    public function render()
    {
        return view('livewire.admin.subscriptions.cancelled-data-table', [
            'subscriptions' => Membership::cancelled()->get(),
        ]);
    }
}
