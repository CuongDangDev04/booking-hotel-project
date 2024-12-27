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
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        $users = User::orderBy($sortBy, $sortOrder)->get();

        return view('admin.users.index', compact('users', 'sortBy', 'sortOrder'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string',
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
