<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminRoomTypeController extends Controller
{
    public function index(Request $request)
{
    $sortBy = $request->get('sort_by', 'name');
    $sortOrder = $request->get('sort_order', 'asc');

    $roomTypes = RoomType::orderBy($sortBy, $sortOrder)->get();
    $services = Service::all(); // Lấy tất cả dịch vụ

    return view('admin.room-types.index', compact('roomTypes', 'sortBy', 'sortOrder', 'services'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'occupancy' => 'required|integer',
            'services' => 'array',
        ]);

        $roomType = RoomType::create($request->only(['name', 'description', 'price', 'occupancy']));
        $roomType->services()->sync($request->services);

        return redirect()->route('admin.room-types.index')->with('success', 'Phòng đã được thêm thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'occupancy' => 'required|integer',
            'services' => 'array',
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->only(['name', 'description', 'price', 'occupancy']));
        $roomType->services()->sync($request->services);

        return redirect()->route('admin.room-types.index')->with('success', 'Phòng đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Phòng đã được xóa thành công!');
    }
}
