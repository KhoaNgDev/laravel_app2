<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCanceledMail;

class CancelExpiredBookings extends Command
{
    protected $signature = 'bookings:cancel-expired';
    protected $description = 'Huỷ booking quá hạn và gửi mail cho khách hàng';

    public function handle()
    {
        try {
            DB::connection()->getPdo();

            $today = now()->startOfDay();
            $bookings = Booking::whereNotIn('status', ['completed', 'canceled'])
                ->whereHas('slots', fn($q) => $q->whereDate('date', '<', $today))
                ->with(['customer', 'slots', 'service'])
                ->get();

            $count = 0;

            foreach ($bookings as $booking) {
                $booking->status = 'canceled'; 
                $booking->save();
                $count++;

                if ($booking->customer && $booking->customer->customer_email) {
                    Mail::to($booking->customer->customer_email)
                        ->send(new BookingCanceledMail($booking));
                }
            }

            Log::info("[Scheduler] Đã huỷ $count booking quá hạn và gửi mail.");
        } catch (\Exception $e) {
            Log::error("[Scheduler] Lỗi: " . $e->getMessage());
        }
    }
}
