<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ProductForm;
use Livewire\Component;

class ProductsCreateForm extends Component
{
    public ProductForm $form;

    public function save()
    {
        $this->form->store();

        $this->dispatch('toast', message: 'Products has been created.');

        $this->redirect(route('admin.products'), true);
    }

    public function updatedFormPrice(): void
    {
        $this->form->price = number_format($this->form->price, 2);
    }

    public function render()
    {
        return view('livewire.admin.products-create-form');
    }
}
