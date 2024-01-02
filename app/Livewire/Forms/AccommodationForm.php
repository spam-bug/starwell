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

    public string $accommodationType = '';
    public string $name = '';
    public string $description = '';
    public string $price = '';
    public int|string $max = '';
    public int|string $capacity = '';
    public $photo;

    public function rules(): array
    {
        $types  = [];

        foreach (AccommodationType::cases() as $case) {
            $types[] = $case->value;
        }

        $types = implode(',', $types);

        $rules = [
            'accommodationType' => ['required', "in:$types"],
            'name' => ['required', 'alpha_spaces'],
            'description' => ['required'],
            'price' => ['required', 'currency'],
            'photo' => ['required'],
        ];

        if (AccommodationType::from($this->accommodationType) !== AccommodationType::Gym) {
            $rules['max'] =  ['required','integer','min:1'];
        }

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Restobar) {
            $rules['capacity'] =  ['required','integer','min:1'];
        }

        if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $rules['photo'] = array_merge($rules['photo'], ['image', 'max:4096', 'dimensions:ratio=1/1']);
        }

        return $rules;
    }


    public function save(): Accommodation
    {
        $this->validate();

        $path = $this->photo->store('photos');

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->formattedPrice(),
            'type' => $this->accommodationType,
            'status' => AccommodationStatus::available,
            'photo' => $path,
        ];

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Resort || AccommodationType::from($this->accommodationType) === AccommodationType::Restobar) {
            $data['max_person'] = $this->max;
        }

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Restobar) {
            $data['max_daily_capacity'] = $this->capacity;
        }

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Barbershop) {
            $data['max_daily_capacity'] = $this->max;
        }

        return Accommodation::create($data);
    }

    public function update(): Accommodation
    {
        $this->validate();

        $data = [
            'accommodation_service_id' => $this->accommodationType,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->formattedPrice(),
        ];

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Resort || AccommodationType::from($this->accommodationType) === AccommodationType::Restobar) {
            $data['max_person'] = $this->max;
        }

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Restobar) {
            $data['max_daily_capacity'] = $this->capacity;
        }

        if (AccommodationType::from($this->accommodationType) === AccommodationType::Barbershop) {
            $data['max_daily_capacity'] = $this->max;
        }

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

        $this->accommodationType = $accommodation->type->value;
        $this->name = $accommodation->name;
        $this->description = $accommodation->description;
        $this->price = number_format(substr($accommodation->price, 0, -2) . '.' . substr($accommodation->price, -2), 2);
        $this->photo = $accommodation->photo;

        if ($accommodation->type !== AccommodationType::Gym) {
            if ($accommodation->type === AccommodationType::Barbershop) {
                $this->max = $accommodation->max_daily_capacity;
            } else {
                $this->max = $accommodation->max_person;
            }
        }

        if ($accommodation->type === AccommodationType::Restobar) {
            $this->capacity = $accommodation->max_daily_capacity;
        }
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
