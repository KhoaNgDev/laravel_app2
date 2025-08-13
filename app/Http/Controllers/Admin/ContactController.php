<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\BrevoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $brevoService;

    public function __construct(BrevoService $brevoService)
    {
        $this->brevoService = $brevoService;
    }
    public function contactList(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->input('month'));
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->input('year'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        $data = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.people.contact-list', compact('data'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,responded,hidden',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = $request->status;
        $testimonial->save();

        return back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.people.show-contacts', compact('testimonial'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,responded,hidden',
            'admin_note' => 'nullable|string|max:200'
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = $request->status;
        $testimonial->admin_note = $request->admin_note;
        $testimonial->save();

        return redirect()->route('admin.contacts.show', $testimonial->id)
            ->with('success', 'Cập nhật đánh giá thành công.');
    }
    public function reply(Request $request, $id)
    {
        try {
            $request->validate([
                'admin_note' => 'required|string|min:5',
            ], [
                'admin_note.required' => 'Vui lòng nhập nội dung phản hồi',
                'admin_note.string' => 'Nội dung phản hồi phải là chuỗi',
                'admin_note.min' => 'Nội dung phản hồi phải ít nhất 5 ký tự',
            ]);


            $data = Testimonial::findOrFail($id);
            $data->admin_note = $request->admin_note;
            $data->status = 'responded';
            $data->save();

            // Gửi email
            $subject = 'Phản hồi từ Admin';
            $content = view('mail.contact_reply', compact('data'))->render();

            $this->brevoService->sendEmail(
                $data->email,
                $subject,
                $content
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Phản hồi đã được gửi thành công'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $ve->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }


}
