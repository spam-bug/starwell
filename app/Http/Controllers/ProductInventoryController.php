<?php

namespace App\Http\Controllers;

use App\Models\ProductInventory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    public function index(): View
    {
        return view('admin.products.inventory');
    }

    public function create(): View
    {
        return view('admin.products.inventory-create');
    }

    public function edit($id): View
    {
        return view('admin.products.inventory-edit', compact('id'));
    }
}
