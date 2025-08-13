<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Models\Service;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookConfirm;
use App\Services\BrevoService;
use Exception;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $bookingService;
    protected $brevoService;

    public function __construct(BookingService $bookingService, BrevoService $brevoService)
    {
        $this->bookingService = $bookingService;
        $this->brevoService = $brevoService;
    }

    public function Booking()
    {
        return view('frontend.pages.booking.booking');
    }

    public function BookingStore(BookingRequest $request)
    {
        $result = $this->bookingService->setupBooking($request);

        if ($result['status']) {
            if (!empty($result['booking'])) {
                try {
                    $this->brevoService->sendEmail(
                        $result['booking']->customer->customer_email,
                        'Xác nhận đặt lịch',
                        view('mail.booking_mail', [
                            'booking' => $result['booking'],
                            'dateBooking' => optional($result['booking']->slots->sortBy('start_time')->first())->date,
                            'startTime' => optional($result['booking']->slots->sortBy('start_time')->first())->start_time ? \Carbon\Carbon::parse(optional($result['booking']->slots->sortBy('start_time')->first())->start_time)->format('H:i') : null,
                            'endTime' => optional($result['booking']->slots->sortBy('start_time')->first())->start_time ? \Carbon\Carbon::parse(optional($result['booking']->slots->sortBy('start_time')->first())->start_time)->addMinutes($result['booking']->service->duration ?? 0)->format('H:i') : null,
                        ])->render()
                    );

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