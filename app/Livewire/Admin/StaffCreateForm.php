<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\StaffForm;
use Livewire\Component;

class StaffCreateForm extends Component
{
    public StaffForm $form;

    public function save(): void
    {
        $this->form->store();

        $this->dispatch('toast', message: 'Staff member has been created');

        $this->redirect(route('admin.staffs'), true);
    }
}
