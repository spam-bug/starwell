<?php

namespace App\Livewire\Admin\Reservations;

use App\Models\Booking;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin'), Title('Paid Reservations')]
class PaidDataTable extends Component
{
    public function render(): View
    {
        return view('livewire.admin.reservations.paid-data-table', [
            'reservations' => Booking::paid()->get(),
        ]);
    }
}
