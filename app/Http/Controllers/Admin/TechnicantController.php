<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Staff\StoreRequest;
use App\Http\Requests\Admin\Staff\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TechnicantController extends Controller
{
    public function index()
    {
        $data = User::where('group_role', 'User')->paginate(10);
        return view('admin.staff.index', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'email', 'phone', 'is_active', 'group_role']);
            $data['password'] = Hash::make($request->password);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/user_images'), $fileName);
                $data['photo'] = 'uploads/user_images/' . $fileName;
            }

            User::create($data);

            DB::commit();

            // Nếu request AJAX, trả về JSON
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Người dùng đã được tạo thành công!'
                ], 200);
            }

            // Nếu request bình thường, redirect
            session()->flash('success', 'Thêm người dùng thành công!');
            return redirect()->route('admin.users.index');

        } catch (Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Đã có lỗi xảy ra: ' . $e->getMessage()
                ], 500);
            }

            session()->flash('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $data = [];

            $data['name'] = $request->input('name');
            $data['email'] = $request->input('email');
            $data['phone'] = $request->input('phone');
            $data['is_active'] = $request->input('is_active');
            $data['group_role'] = $request->input('group_role');

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                if ($user->photo && file_exists(public_path($user->photo))) {
                    unlink(public_path($user->photo));
                }

                $file = $request->file('photo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/user_images'), $fileName);

                $data['photo'] = 'uploads/user_images/' . $fileName;
            }

            $user->update($data);

            DB::commit();

            session()->flash('success', 'Cập nhật người dùng thành công!');
            return redirect()->route('admin.users.index');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


}
