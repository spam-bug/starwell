<?php

namespace App\Livewire\Admin;

use App\Models\User as Staff;
use App\Events\StaffPasswordReset as StaffPasswordResetEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class StaffPasswordReset extends Component
{
    public string $identifier = 'staff-password-reset';

    public Staff $staff;

    public function mount(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function resetPassword(): void
    {
        $password = Str::random(8);

        $this->staff->password = Hash::make($password);
        $this->staff->save();

        event(new StaffPasswordResetEvent($this->staff, $password));

        $this->dispatch('close-dialog');
        $this->dispatch('toast', message: 'Password has been reset.');
    }
}
