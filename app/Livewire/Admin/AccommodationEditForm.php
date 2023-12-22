<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AccommodationForm;
use App\Models\Accommodation;
use App\Models\AccommodationService;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccommodationEditForm extends Component
{
    use WithFileUploads;

    public AccommodationForm $form;

    public function mount(Accommodation $accommodation): void
    {
        $this->form->set($accommodation);
    }

    public function save(): void
    {
        $this->form->update();

        $this->dispatch('toast', message: 'Accommodation has been updated.');

        $this->redirect(route('admin.accommodations'), true);
    }

    public function remove(): void
    {
        $this->form->photo = null;
    }
}
