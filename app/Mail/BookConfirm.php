<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class BookConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;


    public function __construct(Booking $booking)
    {
        $this->booking = $booking->load('customer', 'service', 'slots');
    }

    public function build()
    {
        $slots = $this->booking->slots->sortBy('start_time');

        $dateBooking = optional($slots->first())->date;
        $startTime = optional($slots->first())->start_time;

        $duration = $this->booking->service->duration ?? 0;

        $startCarbon = Carbon::parse($startTime);
        $endCarbon = $startCarbon->copy()->addMinutes($duration);

        return $this->subject('Đơn đặt lịch của bạn đã được xác nhận')
            ->view('mail.booking_mail')
            ->with([
                'booking' => $this->booking,
                'dateBooking' => $dateBooking,
                'startTime' => $startCarbon->format('H:i'),
                'endTime' => $endCarbon->format('H:i'),
            ]);
    }


}
