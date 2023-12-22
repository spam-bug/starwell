<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User as Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(): View
    {
        return view('admin.staff.index');
    }

    public function create(): View
    {
        return view('admin.staff.create');
    }

    public function edit(Staff $staff): View|RedirectResponse
    {
        if (Auth::id() === $staff->id || $staff->isCustomer()) {
            return redirect()->route('admin.staffs');
        }

        return view('admin.staff.edit', compact('staff'));
    }
}
