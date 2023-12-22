<?php

namespace App\Livewire\Forms;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Models\Accommodation;
use App\Models\AccommodationService;
use Livewire\Form;

class AccommodationForm extends Form
{
    public ?Accommodation $accommodation = null;

    public string $service = '';
    public string $name = '';
    public string $description = '';
    public string $price = '';
    public int $maxPerson = 0;
    public $photo;

    public function rules(): array
    {
        $services  = [];

        foreach (AccommodationType::cases() as $case) {
            $services[] = $case->value;
        }

        $services = implode(',', $services);

        $rules = [
            'service' => ['required', "in:$services"],
            'name' => ['required', 'alpha_spaces'],
            'description' => ['required'],
            'price' => ['required', 'currency'],
            'maxPerson' => ['required','integer','min:1'],
            'photo' => ['required'],
        ];

        if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $rules['photo'] = array_merge($rules['photo'], ['image', 'max:2048', 'dimensions:ratio=1/1']);
        }

        return $rules;
    }


    public function save(): Accommodation
    {
        $this->validate();

        $path = $this->photo->store('photos');

        return Accommodation::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->formattedPrice(),
            'type' => $this->service,
            'max_person' =>  $this->maxPerson,
            'available_slots' => $this->maxPerson,
            'status' => AccommodationStatus::available,
            'photo' => $path,
        ]);
    }

    public function update(): Accommodation
    {
        $this->validate();

        $data = [
            'accommodation_service_id' => $this->service,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->formattedPrice(),
            'max_person' => $this->maxPerson,
        ];

        if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $data['photo'] = $this->photo->store('photos');
            # TODO: Delete the photo from the storage.
        }

        $this->accommodation->update($data);

        return $this->accommodation;
    }

    public function set(Accommodation $accommodation): void
    {
        $this->accommodation = $accommodation;

        $this->service = $accommodation->type->value;
        $this->name = $accommodation->name;
        $this->description = $accommodation->description;
        $this->price = number_format(substr($accommodation->price, 0, -2) . '.' . substr($accommodation->price, -2), 2);
        $this->maxPerson = $accommodation->max_person;
        $this->photo = $accommodation->photo;
    }

    private function formattedPrice(): int
    {
        if (! str_contains($this->price, ".")) {
            $this->price .= ".00";
        }

        $this->price = str_replace(",", "", $this->price);
        $this->price = str_replace(".", "", $this->price);

        return (int) $this->price;
    }
}
