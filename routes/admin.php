<?php

use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\AccommodationServiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

Route::prefix('staffs')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('admin.staffs');

    Route::middleware('admin')->group(function () {
        Route::get('/create', [StaffController::class, 'create'])->name('admin.staffs.create');
        Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('admin.staffs.edit');
    });
});

Route::get('/customers', CustomerController::class)->name('admin.customers');
Route::get('/reports', [TransactionController::class, 'index'])->name('admin.reports');
Route::get('reports/download', [TransactionController::class, 'download'])->name('admin.reports.download');

Route::prefix('accommodations')->group(function () {
    Route::get('/', [AccommodationController::class, 'index'])->name('admin.accommodations');
    Route::get('/create', [AccommodationController::class, 'create'])->name('admin.accommodations.create');
    Route::get('/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('admin.accommodations.edit');
});

Route::prefix('equipments')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/download', [\App\Http\Controllers\Admin\ProductController::class, 'download'])->name('admin.products.download');
    Route::get('/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::get('/inventory', [\App\Http\Controllers\ProductInventoryController::class, 'index'])->name('admin.products.inventories');
    Route::get('/inventory/create', [\App\Http\Controllers\ProductInventoryController::class, 'create'])->name('admin.products.inventories.create');
    Route::get('/inventory/{inventory}/edit', [\App\Http\Controllers\ProductInventoryController::class, 'edit'])->name('admin.products.inventories.edit');
});

Route::prefix('reservations')->group(function() {
    Route::get('/pending', \App\Livewire\Admin\Reservations\PendingDataTable::class)->name('admin.reservations.pending');
    Route::get('/paid', \App\Livewire\Admin\Reservations\PaidDataTable::class)->name('admin.reservations.paid');
    Route::get('/reserved', \App\Livewire\Admin\Reservations\ConfirmedDataTable::class)->name('admin.reservations.reserved');
    Route::get('/cancelled', \App\Livewire\Admin\Reservations\CancelledDataTable::class)->name('admin.reservations.cancelled');
});

Route::prefix('subscriptions')->group(function () {
    Route::get('/pending', \App\Livewire\Admin\Subscriptions\PendingDataTable::class)->name('admin.subscriptions.pending');
    Route::get('/active', \App\Livewire\Admin\Subscriptions\ActiveDataTable::class)->name('admin.subscriptions.active');
    Route::get('/cancelled', \App\Livewire\Admin\Subscriptions\CancelledDataTable::class)->name('admin.subscriptions.cancelled');
});

Route::get('/test', function () {
   return \App\Services\Sinch::send('Hello');
});
