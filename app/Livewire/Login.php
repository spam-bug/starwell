<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    public string $identifier = 'login';

    #[Rule('required')]
    public string $username = '';

    #[Rule('required')]
    public string $password = '';

    public function cancel(): void
    {
        $this->dispatch('close-dialog');

        $this->reset();
    }

    public function attempt(): void
    {
        $credentials = $this->validate();

        if (! Auth::attempt($credentials)) {
            $this->addError('login', 'Authentication failed!');
            return;
        }

        if (in_array(Auth::user()->account_type, ['admin', 'staff'])) {
            $this->redirect(route('admin.dashboard'));
            return;
        }

        $this->redirect(route('home'), true);
    }
}
