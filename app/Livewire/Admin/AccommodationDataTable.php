<?php

namespace App\Livewire\Admin;

use App\Models\Accommodation;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AccommodationDataTable extends Component
{
    public string $searchTerm = '';

    public function render(): View
    {
        $value = $this->searchTerm;

        $isNumeric = preg_match('/^[\d,]+(\.\d+)?$/', $value);

        if ($isNumeric) {
            $value = str_replace(',', '', $value);
            $value = str_replace('.', '', $value);
        }

        return view('livewire.admin.accommodation-data-table', [
            'accommodations' => Accommodation::whereLike(['name', 'type', 'price', 'status'], $value)->paginate(10)
        ]);
    }
}
