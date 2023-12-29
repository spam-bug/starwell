<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsDataTable extends Component
{
    use WithPagination;

    public string $searchTerm = '';

    public function render()
    {
        return view('livewire.admin.products-data-table', [
            'products' => Product::whereLike('name', $this->searchTerm)->paginate(10),
        ]);
    }
}
