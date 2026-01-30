<?php

use App\Http\Controllers\AirportCodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VipSignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to(route('login'));
});

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('airport-codes', AirportCodeController::class)->except(['show']);
        Route::resource('vip-signups', VipSignupController::class)->only(['index', 'destroy']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';