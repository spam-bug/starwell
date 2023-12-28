<?php

namespace App\Livewire\Admin\Reservations;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin'), Title('Confirmed Reservations')]
class ConfirmedDataTable extends Component
{
    public function render()
    {
        return view('livewire.admin.reservations.confirmed-data-table', [
            'bookings' => Booking::reserved()->get(),
        ]);
    }
}
