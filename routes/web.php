<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogOutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/accommodations', AccommodationController::class)->name('accommodations');


Route::post('/logout', LogOutController::class)->name('logout');

Route::middleware(['auth', 'customer'])->prefix('{user:username}')->group(function () {
    Route::get('/bookings', BookingController::class)->name('bookings');
});
