<?php

namespace App\Livewire\Forms;

use App\Models\AccommodationService;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServicesForm extends Form
{
    public ?AccommodationService $service = null;

    public string $name = '';

    public function store(): AccommodationService
    {
        $data = $this->validate();

        return AccommodationService::create($data);
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'alpha_spaces'],
        ];

        $rules['name'][] = is_null($this->service)
            ? Rule::unique('accommodation_services', 'name')
            : Rule::unique('accommodation_services', 'name')->ignoreModel($this->service);

        return $rules;
    }

    public function set(AccommodationService $accommodationService): void
    {
        $this->service = $accommodationService;

        $this->name = $accommodationService->name;
    }

    public function update(): AccommodationService
    {
        $data = $this->validate();

        $this->service->update($data);

        return $this->service;
    }
}
