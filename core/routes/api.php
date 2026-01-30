<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;

Route::post('/bookings', [BookingController::class, 'store'])->middleware(['throttle:60,1']); // Rate limiting: 60 requests per minute
Route::get('/search/autocomplete', [BookingController::class, 'searchAirportCodes'])->middleware(['throttle:60,1']); // Rate limiting: 60 requests per minute