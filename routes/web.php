<?php

use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\HomepageController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



// TODO Route: frontend

Route::controller(HomepageController::class)
    ->group(function () {
        Route::get('/', 'Homepage')->name('homepage');
    });
Route::get('/test-mail', function () {
    Mail::raw('Test gửi mail thành công!', function ($message) {
        $message->to('nganhkhoa.becloud@gmail.com')
            ->subject('Thử gửi mail từ Laravel');
    });

    return 'Đã gửi mail!';
});
Route::controller(BookingController::class)
    ->prefix('/booking')
    ->group(function () {
        Route::get('/', 'Booking')->name('booking');
        Route::post('/store', 'BookingStore')->name('booking.store')->middleware('throttle:3,1');
        Route::get('/get-services', 'GetServices')->name('booking.get-services');
        Route::get('/free-times', 'GetFreeTime')->name('booking.free-times');


    });
Route::controller(ContactController::class)
    ->group(function () {
        Route::get('/contact', 'Contact')->name('contact');
        Route::post('/contact/store', 'submitContactForm')->name('contact.store');

    });

require __DIR__ . '/auth.php';
