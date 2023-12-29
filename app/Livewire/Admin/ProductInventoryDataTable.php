<?php

namespace App\Livewire\Admin;

use App\Models\ProductInventory;
use Livewire\Component;
use Livewire\WithPagination;

class ProductInventoryDataTable extends Component
{
    use WithPagination;

    public string $searchTerm = '';

    public function render()
    {
        return view('livewire.admin.product-inventory-data-table', [
            'inventories' => ProductInventory::paginate(10),
        ]);
    }
}
