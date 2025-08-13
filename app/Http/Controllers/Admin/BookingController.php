<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SearchRequest;
use App\Mail\BookingCanceledMail;
use App\Models\Booking;
use App\Models\BookingSlot;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Services\BrevoService;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    public function index(SearchRequest $request)
    {
        $query = Booking::with(['customer', 'technician', 'service', 'slots']);

        if ($request->filled('customer')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('month')) {
            [$year, $month] = explode('-', $request->month);
            $query
                ->whereMonth('booking_start', $month)
                ->whereYear('booking_start', $year);

        } elseif ($request->filled('date')) {
            $query->whereDate('booking_start', $request->date);
        }

        if ($request->filled('technician_id')) {
            $query->where('technician_id', $request->technician_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(10)->withQueryString();
        $technicians = User::where('group_role', 'User')->get();

        return view('admin.bookings.index', compact('bookings', 'technicians'));
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $booking = Booking::with(['customer', 'slots', 'service'])->findOrFail($id);

            if ($booking->status === 'completed') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Đơn đã hoàn tất, không thể thay đổi trạng thái.'
                ], 400);
            }

            if ($request->status === 'canceled') {
                BookingSlot::where('booking_id', $booking->id)->delete();
                $booking->canceled_note = $request->input('note', null);
            }

            $booking->status = $request->status;
            $booking->save();

            if ($request->status === 'canceled' && $booking->customer?->customer_email) {
                // Gửi qua Brevo API
                $brevo = new BrevoService();
                $brevo->sendEmail(
                    $booking->customer->customer_email,
                    'Xác nhận huỷ lịch đặt dịch vụ',
                    view('mail.booking_canceled', ['booking' => $booking])->render()
                );
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật trạng thái thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi cập nhật trạng thái.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $booking = Booking::findOrFail($id);

            if (in_array($booking->status, ['confirmed', 'completed'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không thể xoá lịch đã xác nhận hoặc đã hoàn thành.'
                ], 400);
            }

            $booking->slots()->delete();
            $booking->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Xoá lịch thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi xoá lịch.'
            ], 500);
        }
    }
    public function export(Request $request)
    {
        return Excel::download(new BookingsExport($request), 'export_booking.xlsx');
    }

}
