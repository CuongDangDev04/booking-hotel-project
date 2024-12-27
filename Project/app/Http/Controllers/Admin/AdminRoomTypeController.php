<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'name'); 
        $sortOrder = $request->get('sort_order', 'asc'); 

        $roomTypes = RoomType::orderBy($sortBy, $sortOrder)->get(); 

        return view('admin.room-types.index', compact('roomTypes', 'sortBy', 'sortOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'occupancy' => 'required|integer',
        ]);

        RoomType::create($request->all());
        return redirect()->route('admin.room-types.index')->with('success', 'Phòng đã được thêm thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'occupancy' => 'required|integer',
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());
        return redirect()->route('admin.room-types.index')->with('success', 'Phòng đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Phòng đã được xóa thành công!');
    }
}
