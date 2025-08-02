<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/checkout', [PaymentController::class, 'checkoutPage'])->name('checkout');
});

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payment routes
    Route::post('/pay', [PaymentController::class, 'payNow'])->name('pay');
    Route::get('/success/{id}', [PaymentController::class, 'success'])->middleware('check.payment')->name('success');
});

require __DIR__.'/auth.php';
