<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class AdminContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $testimonial;

    public function __construct($testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function build()
    {
        return $this->subject('Phản hồi góp ý từ quản trị viên')
            ->view('mail.contact_reply');
    }
}