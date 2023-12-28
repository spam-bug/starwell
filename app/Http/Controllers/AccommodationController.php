<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index(): View
    {
        return view('accommodations.index');
    }

    public function show(Accommodation $accommodation)
    {
        return view('accommodations.show', compact('accommodation'));
    }
}
