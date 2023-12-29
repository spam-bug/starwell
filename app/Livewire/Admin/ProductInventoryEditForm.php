<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\InventoryForm;
use App\Models\ProductInventory;
use Livewire\Component;

class ProductInventoryEditForm extends Component
{
    public InventoryForm $form;

    public function mount($id)
    {
        $this->form->set($id);
    }

    public function save(): void
    {
        $this->form->update();

        $this->dispatch('toast', message: 'Inventory has been updated.');

        $this->redirect(route('admin.products.inventories'), true);
    }

    public function render()
    {
        return view('livewire.admin.product-inventory-edit-form');
    }
}
