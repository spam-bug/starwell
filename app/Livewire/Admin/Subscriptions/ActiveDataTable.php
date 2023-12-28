<?php

namespace App\Livewire\Admin\Subscriptions;

use App\Models\Membership;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin'), Title('Active Subscriptions')]
class ActiveDataTable extends Component
{
    public function render()
    {
        return view('livewire.admin.subscriptions.active-data-table', [
            'subscriptions' => Membership::active()->get(),
        ]);
    }
}
