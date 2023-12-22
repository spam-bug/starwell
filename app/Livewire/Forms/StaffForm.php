<?php

namespace App\Livewire\Forms;

use App\Events\DefaultPassword;
use App\Models\User as Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Form;

class StaffForm extends Form
{
    public ?Staff $staff= null;

    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $accountType = 'admin';

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'alpha_spaces'],
            'email' => ['required', 'email'],
            'username' => ['required', 'min:3', 'alpha_dash'],
            'accountType' => ['required'],
        ];

        $rules['email'][] = is_null($this->staff)
            ? Rule::unique('users', 'email')
            : Rule::unique('users', 'email')->ignoreModel($this->staff);

        $rules['username'][] = is_null($this->staff)
            ? Rule::unique('users', 'username')
            : Rule::unique('users', 'username')->ignoreModel($this->staff);

        return $rules;
    }

    public function store(): Staff
    {
        $data = $this->validate();

        $data['account_type'] = $this->accountType;
        unset($data['accountType']);

        $password = Str::random(8);

        $data['password'] = Hash::make($password);

        $staff = Staff::create($data);

        event(new DefaultPassword($staff, $password));

        return $staff;
    }

    public function update(): Staff
    {
        $data = $this->validate();

        $data['account_type'] = $this->accountType;
        unset($data['accountType']);

        $this->staff->update($data);

        return Staff::find($this->staff->id);
    }

    public function set(Staff $staff): void
    {
        $this->staff = $staff;

        $this->name = $staff->name;
        $this->username = $staff->username;
        $this->email = $staff->email;
        $this->accountType = $staff->account_type;
    }
}
