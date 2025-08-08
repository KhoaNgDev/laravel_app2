<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.pages.contact.contact');
    }
    public function submitContactForm(ContactRequest $request)
    {
        $lastSubmitted = session('last_contact_submit');
        if ($lastSubmitted && now()->diffInSeconds($lastSubmitted) < 60) {
            return redirect()->back()->with('error', 'Bạn vừa gửi, vui lòng thử lại sau 1 phút.');
        }

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
                Mail::to($contact->email)->send(new ContactMail($contact));
            }
            session(['last_contact_submit' => now()]);
            return redirect()->back()->with('success', 'Cảm ơn quý khách hàng đã phản hồi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }



}



