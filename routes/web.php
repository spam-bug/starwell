<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\SubscriptionController;
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
Route::get('/terms', function () {
    return view('terms');
});
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::post('/logout', LogOutController::class)->name('logout')->middleware('auth');

Route::prefix('accommodations')->group(function () {
    Route::get('/', [AccommodationController::class, 'index'])->name('accommodations');
    Route::get('/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');
});





Route::middleware(['auth', 'verified', 'customer'])->prefix('{user:username}')->group(function () {
    Route::get('/bookings', BookingController::class)->name('bookings');
    Route::get('subscriptions', SubscriptionController::class)->name('subscriptions');
});

Route::prefix('email')->group(function () {
    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('verification-notification', [EmailVerificationController::class, 'resend'])->name('verification.send');

    Route::get('/verification', function () {
        return view('verification');
    })->name('verification.notice');
});
