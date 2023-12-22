<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index(): View
    {
        return view('admin.accommodations.index');
    }

    public function create(): View
    {
        return view('admin.accommodations.create');
    }

    public function edit(Accommodation $accommodation): View
    {
        return view('admin.accommodations.edit', compact('accommodation'));
    }
}
