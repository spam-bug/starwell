<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\StaffForm;
use App\Models\User as Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component;

class StaffEditForm extends Component
{
    public StaffForm $form;

    public function mount(Staff $staff): void
    {
        $this->form->set($staff);
    }

    public function save(): void
    {
        $user = $this->form->update();

        $this->dispatch('toast', message: Str::title($user->name) . " account has been updated.");

        $this->redirect(route('admin.staffs'), true);
    }

    public function render(): View
    {
        return view('livewire.admin.staff-edit-form');
    }
}
