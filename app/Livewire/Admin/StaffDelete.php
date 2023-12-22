<?php

namespace App\Livewire\Admin;

use App\Models\User as Staff;
use Livewire\Component;

class StaffDelete extends Component
{
    public string $identifier = 'staff-delete';

    public Staff $staff;

    public function mount(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function delete(): void
    {
        $this->staff->delete();

        $this->dispatch('close-dialog');
        $this->dispatch('toast', message: "Staff deleted successfully.");

        $this->redirect(route('admin.staffs'), true);
    }
}
