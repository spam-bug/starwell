<?php

use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\AccommodationServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

Route::prefix('staffs')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('admin.staffs');

    Route::middleware('admin')->group(function () {
        Route::get('/create', [StaffController::class, 'create'])->name('admin.staffs.create');
        Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('admin.staffs.edit');
    });
});

Route::prefix('accommodations')->group(function () {
    Route::get('/', [AccommodationController::class, 'index'])->name('admin.accommodations');
    Route::get('/create', [AccommodationController::class, 'create'])->name('admin.accommodations.create');
    Route::get('/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('admin.accommodations.edit');
});

Route::prefix('reservations')->group(function() {
    Route::get('/pending', \App\Livewire\Admin\Reservations\PendingDataTable::class)->name('admin.reservations.pending');
    Route::get('/paid', \App\Livewire\Admin\Reservations\PaidDataTable::class)->name('admin.reservations.paid');
});
