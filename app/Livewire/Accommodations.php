<?php

namespace App\Livewire;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Models\Accommodation;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Accommodations extends Component
{
    public int $totalAccommodations;
    public int $perPage = 5;
    public string $searchTerm = '';
    public string $type = '';
    public array $maxPersonChoices = [];
    public int $maxPerson = 0;
    public string $price = 'asc';

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(): void
    {
        $this->totalAccommodations = Accommodation::whereStatus(AccommodationStatus::available)->count();

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
        return view('livewire.accommodations', [
            'accommodations' => Accommodation::whereLike('name', $this->searchTerm)
                ->whereLike('type', $this->type)
                ->when($this->maxPerson, function ($query) {
                    $query->whereLike('max_person', $this->maxPerson);
                })
                ->where('status', AccommodationStatus::available)
                ->orderBy('price', $this->price)
                ->take($this->perPage)->get(),
        ]);
    }
}
