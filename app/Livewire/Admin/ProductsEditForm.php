<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Component;

class ProductsEditForm extends Component
{
    public ProductForm $form;

    public function mount(Product $product)
    {
        $this->form->set($product);
    }

    public function updatedFormPrice(): void
    {
        $this->form->price = number_format($this->form->price, 2);
    }

    public function save(): void
    {
        $this->form->update();

        $this->dispatch('toast', message: 'Equipment has been updated.');

        $this->redirect(route('admin.products'), true);
    }

    public function render()
    {
        return view('livewire.admin.products-edit-form');
    }
}
