<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class RegistrationForm extends Form
{
    #[Rule('required|alpha_spaces')]
    public string $name = '';

    #[Rule('required|alpha_dash|min:3|unique:users,username')]
    public string $username = '';

    #[Rule('required|email|unique:users,email')]
    public string $email = '';

    #[Rule('required|string|min:8')]
    public string $password = '';

    #[Rule('required')]
    public string $address = '';

    #[Rule('required|ph_mobile_number')]
    public string $contactNumber;

    public function store(): User
    {
        $data = $this->validate();

        $data['password'] = Hash::make($data['password']);

        $data['contact_number'] = $data['contactNumber'];
        unset($data['contactNumber']);

        $data['has_default_password'] = false;
        $data['account_type'] = 'customer';

        return User::create($data);
    }
}
