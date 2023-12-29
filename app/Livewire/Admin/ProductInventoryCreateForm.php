<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\InventoryForm;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductInventoryCreateForm extends Component
{
    public Collection $products;

    public InventoryForm $form;

    public function mount()
    {
        $this->products = Product::where('available', '!=', 0)->get();
        $this->form->product = $this->products->first()->id;
    }

    public function save(): void
    {
        $this->form->store();

        $this->dispatch('toast', message: 'Product has been created.');

        $this->redirect(route('admin.products.inventories'), true);
    }

    public function render()
    {
        return view('livewire.admin.product-inventory-create-form');
    }
}
