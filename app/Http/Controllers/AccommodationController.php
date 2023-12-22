<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function __invoke(): View
    {
        return view('accommodations');
    }
}
