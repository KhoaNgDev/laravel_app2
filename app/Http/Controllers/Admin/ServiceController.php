<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index()
    {
        $data = Service::paginate(5);
        return view('admin.services.index', compact('data'));
    }
    public function store(ServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            Service::create($request->validated());
            DB::commit();
            return redirect()->back()->with([
                'message' => 'Đã thêm dịch vụ thành công',
                'alert-type' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'message' => 'Tạo mới thất bại',
                'alert-type' => 'error'
            ]);
        }
    }

    public function update(ServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $service = Service::findOrFail($request->id);
            $service->update($request->validated());
            DB::commit();
            return redirect()->back()->with([
                'message' => 'Đã cập nhập dịch vụ thành công',
                'alert-type' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'message' => 'Cập nhật thất bại',
                'alert-type' => 'error'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = Service::findOrFail($request->id);

            if ($service->bookings()->exists()) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không thể xoá dịch vụ đã được đặt',
                ]);
            }

            $service->delete();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Đã xoá dịch vụ thành công',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Xoá thất bại: ' . $e->getMessage(),
            ]);
        }
    }



}
