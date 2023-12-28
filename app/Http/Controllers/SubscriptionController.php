<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __invoke()
    {
        return view('subscriptions');
    }
}
