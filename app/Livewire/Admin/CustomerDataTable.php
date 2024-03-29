<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerDataTable extends Component
{
    use WithPagination;

    public string $searchTerm = '';

    public function render()
    {
        return view('livewire.admin.customer-data-table', [
            'customers' => User::where('account_type', 'customer')
                ->whereLike(['name', 'username', 'email', 'address', 'contact_number'], $this->searchTerm)
                ->paginate(10),
        ]);
    }
}
