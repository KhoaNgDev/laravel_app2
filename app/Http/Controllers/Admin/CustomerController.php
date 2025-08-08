<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerList()
    {
        $data = Customer::withCount('bookings')
            ->having('bookings_count', '>', 0)
            ->orderByDesc('bookings_count')
            ->paginate(20);
        return view('admin.people.customer-list', compact('data'));
    }

}
