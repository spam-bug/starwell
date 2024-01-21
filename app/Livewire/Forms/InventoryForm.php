<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\ProductInventory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InventoryForm extends Form
{
    public ?ProductInventory $inventory = null;

    public $customer_name = '';
    public $customer_id = '';
    public $customer_id_number = '';
    public $product = '';
    public $quantity = '';
    public $return_quantity ='';
    public $damage_quantity = '';


    public function store()
    {
        $this->validate([
            'customer_name' => ['required', 'alpha_spaces'],
            'customer_id' => ['required'],
            'customer_id_number' => ['required'],
            'product' => ['required'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::find($this->product);

        $product->available -= $this->quantity;
        $product->save();

        return $product->inventories()->create([
            'customer_name' => $this->customer_name,
            'customer_id' => $this->customer_id,
            'customer_id_number' => $this->customer_id_number,
            'rented_quantity' => $this->quantity,
            'status' => 'rented'
        ]);
    }

    public function set($id)
    {
        $this->inventory = ProductInventory::find($id);
    }

    public function update()
    {
        $data = $this->validate([
            'return_quantity' => ['required', 'integer', 'min:1'],
        ]);

        $this->inventory->return_quantity = $this->return_quantity;
        
        if(! empty($this->damage_quantity)) {
            $this->inventory->damage_quantity = $this->damage_quantity;
        }

        $this->inventory->status = 'return';

        $this->inventory->save();

        $product = $this->inventory->product;

        $deduction = !empty($this->damage_quantity) ? $this->return_quantity - $this->damage_quantity : $this->return_quantity;



        if (!empty($this->damage_quantity)) {
            $product->damage = $this->damage_quantity;
        }

        $product->available = $product->available + $deduction;
        $product->save();
    }
}
