<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'booking_id');  
        $sortOrder = $request->input('sort_order', 'asc');     

        $bookings = Booking::with(['customer', 'room', 'user'])
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return view('admin.bookings.index', compact('bookings', 'sortBy', 'sortOrder'));
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
