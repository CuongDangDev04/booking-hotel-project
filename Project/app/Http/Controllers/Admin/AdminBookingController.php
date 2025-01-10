<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'booking_id');
        $sortOrder = $request->input('sort_order', 'asc');

        $bookedRoomIds = Booking::where('checkin', '<=', now())
            ->where('checkout', '>=', now())
            ->pluck('room_id');

        $allRooms = Room::all();

        $availableRooms = $allRooms->whereNotIn('room_id', $bookedRoomIds);

        $bookings = Booking::with(['customer', 'room', 'user'])
            ->orderBy($sortBy, $sortOrder)
            ->paginate(7);


        return view('admin.bookings.index', compact('bookings', 'sortBy', 'sortOrder', 'availableRooms'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $status = $request->input('status');

        $booking->status = $status;
        $booking->save();

        foreach ($booking->receipts as $receipt) {
            $receipt->status = $status;
            $receipt->save();
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật trạng thái booking và hóa đơn thành công!');
    }
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $status = $request->input('status');

        $booking->status = $status;
        $booking->save();

        foreach ($booking->receipts as $receipt) {
            $receipt->status = $status;
            $receipt->save();
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật trạng thái booking và hóa đơn thành công!');
    }


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Xóa đặt phòng thành công.');
    }
}
