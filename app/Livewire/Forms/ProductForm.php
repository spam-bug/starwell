<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public $name = '';
    public $price = '';
    public $quantity = '';

    public function rules()
    {
        return [
            'name' => ['required', 'alpha_spaces'],
            'price' => ['required', 'currency'],
            'quantity' => ['required', 'min:1'],
        ];
    }

    public function store()
    {
        $data = $this->validate();

        $data['available'] = $this->quantity;
        $data['price'] = $this->formattedPrice();

        return Product::create($data);
    }

    public function set(Product $product)
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->price = number_format(substr($product->price, 0, -2) . '.' . substr($product->price, -2), 2);
        $this->quantity = $product->quantity;
    }

    public function update()
    {
        $data = $this->validate();

        if ($this->quantity > $this->product->quantity) {
            $data['available'] = ($this->quantity - $this->product->quantity) + $this->product->available;
        }

        $data['price'] = $this->formattedPrice();

        $this->product->update($data);

        return $this->product;
    }

    private function formattedPrice(): int
    {
        if (! str_contains($this->price, ".")) {
            $this->price .= ".00";
        }

        $this->price = str_replace(",", "", $this->price);
        $this->price = str_replace(".", "", $this->price);

        return (int) $this->price;
    }
}
