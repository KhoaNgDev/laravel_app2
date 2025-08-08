<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function AdminDashboard(Request $request)
    {
        $serviceFilter = $request->input('serviceFilter');
        $status = $request->input('status', 'all');
        $month = $request->input('month', Carbon::now()->month);
        $ratingFilter = $request->input('rating');


        $totalUsers = User::where('group_role', 'User')
            ->count();

        $totalServices = Service::count();
        $totalBookings = Booking::count();


        $testimonialQuery = Testimonial::whereMonth('created_at', $month);
        $dataService = Service::all();

        if ($ratingFilter) {
            $testimonialQuery->where('rating', $ratingFilter);
        }

        $countRatingFiltered = $testimonialQuery->count();

        $recentBookings = Booking::with(['customer', 'service', 'slots'])
            ->when($serviceFilter, fn($query) => $query->where('service_id', $serviceFilter))
            ->when($status !== 'all', fn($query) => $query->where('status', $status))
            ->orderByDesc('created_at') 
            ->take(5)
            ->get();

        $testimonialsPaginated = $testimonialQuery
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('admin.dashboard.index', compact(
            'month',
            'ratingFilter',
            'serviceFilter',
            'status',
            'totalUsers',
            'totalServices',
            'totalBookings',
            'dataService',
            'countRatingFiltered',
            'recentBookings',
            'testimonialsPaginated'
        ));

    }

}
