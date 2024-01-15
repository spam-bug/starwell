<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ProductDelete extends Component
{
    public string $identifier = 'product-delete';

    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function delete(): void
    {
        if ($this->product->inventories()->count())
        {
            foreach ($this->product->inventories as $inventory) {
                $inventory->product_id = null;
                $inventory->save();
            }
        }

        $this->product->delete();

        $this->dispatch('toast', message: 'Equipment has been deleted.');

        $this->redirect(route('admin.products'), true);
    }
}
