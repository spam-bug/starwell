<?php

namespace App\Livewire;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Models\Accommodation;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Accommodations extends Component
{
    public int $totalAccommodations = 0;
    public int $perPage = 5;
    public string $type = '';
    public array $maxPersonChoices = [];
    public int $maxPerson = 0;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(): void
    {
        if ($this->totalAccommodations) {
            $this->maxPersonChoices = Accommodation::distinct()->pluck('max_person')->toArray();
        }
    }

    public function loadMore(): void
    {
        $this->perPage += 5;
    }

    public function render(): View
    {
        $this->totalAccommodations = Accommodation::whereLike('type', $this->type)
            ->when($this->maxPerson, function ($query) {
                $query->whereLike('max_person', $this->maxPerson);
            })->whereStatus(AccommodationStatus::available)->count();

        return view('livewire.accommodations', [
            'accommodations' => Accommodation::whereLike('type', $this->type)
                ->when($this->maxPerson, function ($query) {
                    $query->whereLike('max_person', $this->maxPerson);
                })
                ->where('status', AccommodationStatus::available)
                ->take($this->perPage)->get(),
        ]);
    }
}
