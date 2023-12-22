<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationService;
use Illuminate\Contracts\View\View;

class AccommodationServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.accommodation-services.index');
    }

    public function create(): View
    {
        return view('admin.accommodation-services.create');
    }

    public function edit(AccommodationService $accommodationService): View
    {
        return view('admin.accommodation-services.edit', compact('accommodationService'));
    }
}
