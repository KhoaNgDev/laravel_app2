<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Models\Service;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookConfirm;
use Exception;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function Booking()
    {
        return view('frontend.pages.booking.booking');
    }

    public function BookingStore(BookingRequest $request)
    {
        // $lastSubmitted = session('last_booking_submit');

        // if ($lastSubmitted && now()->diffInSeconds($lastSubmitted) < 30) {
        //     return redirect()->back()->with('error', 'Bạn thao tác quá nhanh, vui lòng thử lại sau.');
        // }

        // session(['last_booking_submit' => now()]);

        $result = $this->bookingService->setupBooking($request);

        if ($result['status']) {
            if (!empty($result['booking'])) {
                try {
                    Mail::to($result['booking']->customer->customer_email)
                        ->send(new BookConfirm($result['booking']));
                } catch (Exception $e) {
                    Log::error('Lỗi gửi mail: ' . $e->getMessage());
                }
            }

            return redirect()->back()->with('success', 'Xin cảm ơn quý khách đã đặt lịch.');
        }

        return redirect()->back()->withInput()->with('error', $result['message']);
    }



    public function GetServices()
    {
        return response()->json(
            Service::select('id', 'service_name', 'duration')->get()
        );
    }

    public function GetFreeTime(Request $request)
    {
        return response()->json(
            $this->bookingService->getAvailableTimes(
                $request->input('date'),
                $request->input('service_id')
            )
        );
    }
}   