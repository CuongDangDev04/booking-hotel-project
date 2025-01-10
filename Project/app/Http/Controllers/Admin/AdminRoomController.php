<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index(Request $request)
{
    $sortBy = $request->get('sort_by', 'room_id');   
    $sortOrder = $request->get('sort_order', 'asc');  

    $rooms = Room::with('roomType')
                 ->orderBy($sortBy, $sortOrder)
                 ->paginate(10);

    $roomTypes = RoomType::all();

    return view('admin.rooms.index', compact('rooms', 'roomTypes', 'sortBy', 'sortOrder'));
}

    public function store(Request $request)
    {
        $request->validate([
            'roomNo' => 'required|unique:rooms|max:255',
            'roomType_id' => 'required|exists:room_types,roomType_id',
            'status' => 'boolean',
            'floor' => 'required|integer',
        ], [
            'roomNo.required' => 'Số phòng là bắt buộc.',
            'roomNo.unique' => 'Số phòng đã tồn tại.',
            'roomNo.max' => 'Số phòng không được vượt quá 255 ký tự.',
            'roomType_id.required' => 'Loại phòng là bắt buộc.',
            'roomType_id.exists' => 'Loại phòng không tồn tại.',
            'status.boolean' => 'Trạng thái phải là đúng hoặc sai.',
            'floor.integer' => 'Số tầng không hợp lệ',
            'floor.required' => 'Số tầng là bắt buộc',
        ]);
    
        Room::create($request->all());
        return redirect()->route('admin.rooms.index')->with('success', 'Thêm phòng thành công.');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'roomNo' => 'required|max:255|unique:rooms,roomNo,' . $id . ',room_id',
            'roomType_id' => 'required|exists:room_types,roomType_id',
            'status' => 'required|boolean',
            'floor' => 'nullable|integer',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());
        return redirect()->route('admin.rooms.index')->with('success', 'Cập nhật phòng thành công.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Xóa phòng thành công.');
    }
}
