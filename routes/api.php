<?php

use App\Http\Requests\Frontend\BookingRequest;
use App\Services\BookingService;

use Illuminate\Support\Facades\Route;

Route::post('/test-booking', function (BookingRequest $request) {
    $service = app(BookingService::class);
    return response()->json($service->setupBooking($request));
});
