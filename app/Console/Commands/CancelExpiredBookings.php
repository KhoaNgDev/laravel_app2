<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use GuzzleHttp\Client;

class CancelExpiredBookings extends Command
{
    protected $signature = 'bookings:cancel-expired';
    protected $description = 'Huỷ booking quá hạn và gửi mail qua Brevo cho khách hàng';

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

            // Cấu hình Brevo
            $config = Configuration::getDefaultConfiguration()
                ->setApiKey('api-key', config('services.brevo.key'));
            $brevoApi = new TransactionalEmailsApi(new Client(), $config);

            foreach ($bookings as $booking) {
                $booking->status = 'canceled';
                $booking->save();
                $count++;

                if ($booking->customer && $booking->customer->customer_email) {
                    $email = new SendSmtpEmail([
                        'to' => [
                            ['email' => $booking->customer->customer_email, 'name' => $booking->customer->customer_name]
                        ],
                        'sender' => [
                            'name' => config('mail.from.name'),
                            'email' => config('mail.from.address')
                        ],
                        'subject' => 'Xác nhận huỷ lịch đặt dịch vụ',
                        'htmlContent' => view('mail.booking_canceled', ['booking' => $booking])->render(),
                    ]);

                    try {
                        $brevoApi->sendTransacEmail($email);
                    } catch (Exception $e) {
                        Log::error("[Scheduler] Gửi mail thất bại: " . $e->getMessage());
                    }
                }
            }

            Log::info("[Scheduler] Đã huỷ $count booking quá hạn và gửi mail qua Brevo.");
        } catch (Exception $e) {
            Log::error("[Scheduler] Lỗi: " . $e->getMessage());
        }
    }
}
