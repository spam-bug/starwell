<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'damage',
        'available',
        'quantity',
    ];

    public function inventories()
    {
        return $this->hasMany(ProductInventory::class);
    }

    public function unitPrice(): string
    {
        return "₱" . number_format(substr($this->price, 0, -2) . '.' . substr($this->price, -2), 2);
    }

    public function totalCost(): string
    {
        $total = $this->price * $this->quantity;

        return "₱" . number_format(substr($total, 0, -2) . '.' . substr($total, -2), 2);
    }

    public function rentedQuantity(): int
    {
        if ($this->inventories()->count()) {
            return $this->inventories()->latest()->first()->rented_quantity;
        }

        return 0;
    }
}
