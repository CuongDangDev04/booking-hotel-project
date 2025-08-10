<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');

        $users = User::where('role', 'user')  
            ->orderBy($sortBy, $sortOrder)    
            ->paginate(7);


        return view('admin.users.index', compact('users', 'sortBy', 'sortOrder'));
    }



    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'nullable|string',
    ], [
        'name.required' => 'Tên là bắt buộc.',
        'email.required' => 'Email là bắt buộc.',
        'email.email' => 'Email không hợp lệ.',
        'email.unique' => 'Email này đã được sử dụng.',
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        'role.string' => 'Vai trò không hợp lệ.',
    ]);

    try {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => FacadesHash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm!');
    } catch (\Exception $e) {
        return redirect()->route('admin.users.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
    }
}



public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'nullable|string',
    ], [
        'name.required' => 'Tên là bắt buộc.',
        'name.string' => 'Tên phải là chuỗi văn bản.',
        'name.max' => 'Tên không được vượt quá 255 ký tự.',
        'email.required' => 'Email là bắt buộc.',
        'email.email' => 'Email không hợp lệ.',
        'email.unique' => 'Email này đã được sử dụng.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        'role.string' => 'Vai trò không hợp lệ.',
    ]);

    try {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? FacadesHash::make($request->password) : $user->password,
            'role' => $request->role ?? $user->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được cập nhật!');
    } catch (\Exception $e) {
        return redirect()->route('admin.users.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
    }
}


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function toggleActiveStatus($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_active = !$user->is_active;
            $user->save();

            return redirect()->route('admin.users.index')->with('success', $user->is_active ? 'Tài khoản đã được kích hoạt!' : 'Tài khoản đã bị vô hiệu hóa!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
}
