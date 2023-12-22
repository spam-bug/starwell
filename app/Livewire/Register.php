<?php

namespace App\Livewire;

use App\Livewire\Forms\RegistrationForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public string $identifier = 'register';

    public RegistrationForm $form;

    public function cancel(): void
    {
        $this->dispatch('close-dialog');

        $this->form->reset();
    }

    public function register(): void
    {
        $user = $this->form->store();

        Auth::login($user);

        $this->redirect(route('home'), true);
    }
}
