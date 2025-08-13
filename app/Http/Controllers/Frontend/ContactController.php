<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.pages.contact.contact');
    }
    public function submitContactForm(ContactRequest $request)
    {

        DB::beginTransaction();
        try {
            $contact = Testimonial::create([
                'name' => $request->name,
                'message' => $request->message,
                'email' => $request->email,
                'phone' => $request->phone,
                'rating' => $request->rating,
            ]);

            DB::commit();


            if (!empty($contact->email)) {
                $config = Configuration::getDefaultConfiguration()
                    ->setApiKey('api-key', config('services.brevo.api_key'));

                $apiInstance = new TransactionalEmailsApi(
                    new \GuzzleHttp\Client(),
                    $config
                );

                $sendSmtpEmail = new SendSmtpEmail([
                    'subject' => 'Cảm ơn bạn đã liên hệ',
                    'sender' => ['name' => config('mail.from.name'), 'email' => config('mail.from.address')],
                    'to' => [['email' => $contact->email, 'name' => $contact->name]],
                    'htmlContent' => view('mail.contact_mail', ['testimonial' => $contact])->render(),
                ]);

                $apiInstance->sendTransacEmail($sendSmtpEmail);
            }

            session(['last_contact_submit' => now()]);

            return redirect()->back()->with('success', 'Cảm ơn quý khách hàng đã phản hồi!');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Lỗi gửi form liên hệ', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Đã có lỗi kỹ thuật xảy ra: ' . $e->getMessage());
        }
    }




}



