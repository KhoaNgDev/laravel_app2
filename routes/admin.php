<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TechnicantController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Admin'])
    ->group(function () {
        // TODO ADMIN
        Route::controller(DashboardController::class)
            ->prefix('/dashboard')
            ->name('dashboard.')
            ->group(function () {
            Route::get('/', 'AdminDashboard')->name('index');

        });
        // TODO ROUTE ADMIN CONTROLLER
        Route::controller(AdminController::class)
            ->group(function () {
            Route::get('/logouts', 'AdminLogout')->name('logouts');
            Route::get('/profile', 'AdminProfile')->name('profile');
            Route::post('/profile/store', 'AdminProfileStore')->name('profile.store');
            Route::get('/password/change', 'AdminChangePassword')->name('password.change');
            Route::post('/update/password', 'AdminPasswordUpdate')->name('update.password');

        });
        // TODO ROUTE CUSTOMER CONTROLLER
        Route::controller(CustomerController::class)
            ->prefix('/customers')
            ->name('customers.')
            ->group(function () {
            Route::get('/', 'index')->name('index');
        });
        // TODO ROUTE SERVICE CONTROLLER
        Route::controller(ServiceController::class)
            ->prefix('/service')
            ->name('service.')
            ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/destroy', 'destroy')->name('destroy');
        });
        // TODO ROUTE BOOKING CONTROLLER
        Route::controller(BookingController::class)
            ->prefix('/bookings')
            ->name('bookings.')
            ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/export', 'export')->name('export');

            Route::post('/{id}/status', 'updateStatus')->name('updateStatus');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // TODO ROUTE CUSTOMERS CONTROLLER
        Route::controller(CustomerController::class)
            ->prefix('/customers')
            ->name('customers.')
            ->group(function () {
            Route::get('/', 'CustomerList')->name('index');
        });

        // TODO ROUTE CONTACT CONTROLLER
        Route::controller(ContactController::class)
            ->prefix('/contacts')
            ->name('contacts.')
            ->group(function () {
            Route::get('/', 'ContactList')->name('index');
            Route::patch('/{id}/status', 'updateStatus')->name('update-status');
            Route::get('/{id}', 'show')->name('show');
            Route::patch('{id}/reply', 'reply')->name('reply');
            Route::put('{id}/', 'update')->name('update');

        });

        // TODO ROUTE TECHNICIANTS CONTROLLER
        Route::controller(TechnicantController::class)
            ->prefix('/techs')
            ->name('techs.')
            ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');

        });

    });


Route::get('/admins/login', function () {
    return view('admin.auth.login');
})->name('admins.login');


require __DIR__ . '/auth.php';