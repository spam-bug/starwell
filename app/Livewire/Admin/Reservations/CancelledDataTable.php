<?php

namespace App\Livewire\Admin\Reservations;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('layouts.admin'), Title('Cancelled Reservations')]
class CancelledDataTable extends Component
{
    public function render()
    {
        return view('livewire.admin.reservations.cancelled-data-table', [
            'bookings' => Booking::cancelled()->get(),
        ]);
    }
}
