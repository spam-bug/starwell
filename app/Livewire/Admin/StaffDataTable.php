<?php

namespace App\Livewire\Admin;

use App\Models\User as Staff;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class StaffDataTable extends Component
{
    use WithPagination;

    public string $searchTerm = '';

    public function updatingSearchTerm(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.admin.staff-data-table', [
            'staffs' => Staff::member()->whereLike(['name', 'username', 'email'], $this->searchTerm)->paginate(5),
        ]);
    }
}
