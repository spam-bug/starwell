<?php

namespace App\Livewire\Admin;

use App\Models\Accommodation;
use Livewire\Component;

class AccommodationDelete extends Component
{
    public string $identifier = 'accommodation-delete';

    public Accommodation $accommodation;

    public function mount(Accommodation $accommodation) {
        $this->accommodation = $accommodation;
    }

    public function delete(): void
    {
        $this->accommodation->delete();

        $this->dispatch('toast', message: 'Accommodation has been deleted.');

        $this->redirect(route('admin.accommodations'), true);
    }
}
