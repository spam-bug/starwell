<?php

namespace App\Livewire\Admin;

use App\Enums\AccommodationType;
use App\Livewire\Forms\AccommodationForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccommodationCreateForm extends Component
{
    use WithFileUploads;

    public AccommodationForm $form;

    public function mount(): void
    {
        $this->form->accommodationType = AccommodationType::Resort->value;
    }

    public function updatedFormPrice(): void
    {
        $this->form->price = number_format($this->form->price, 2);
    }

    public function save(): void
    {
        $this->form->save();

        $this->dispatch('toast', message: 'Accommodation has been created.');

        $this->redirect(route('admin.accommodations'), true);
    }

    public function remove(): void
    {
        $this->form->photo = null;
    }
}
