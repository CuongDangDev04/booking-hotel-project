<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Receipt;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookingRoom(Request $request)
    {
        $roomType = RoomType::find($request->input('room_id'));
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $totalRoom = (int) $request->input('totalRoom');
        $adults = (int) $request->input('adults');
        $children = (int) $request->input('children');
        $guests = $adults + $children;

        // dd($firstname, $lastname, $email, $phone, $address, $checkin, $checkout, $totalRoom, $adults, $children);

        $errors = [];
        if (strtotime($checkin) >= strtotime($checkout)) {
            $errors['date'] = 'Ngày nhận phòng phải nhỏ hơn ngày trả phòng.';
        }
        $maxGuests = $roomType->occupancy * $totalRoom; // Tổng số người tối đa cho tất cả các phòng đã đặt
        if ($guests > $maxGuests) {
            $errors['guests'] = 'Số lượng khách vượt quá khả năng chứa của phòng.';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $customer = Customer::create([
            'firstName' => $firstname,
            'lastName' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ]);
        $availableRooms = Room::where('roomType_id', $roomType->roomType_id)->count();
        if ($availableRooms >= $totalRoom) {
            $rooms = Room::where('roomType_id', $roomType->roomType_id)->where('status', 0)->limit($totalRoom)->get();
        } else {
            return back()->withErrors(['room' => 'Loại phòng này chỉ còn ' . $availableRooms . ' phòng.']);
        }
        $receipt = Receipt::create([
            'issueDate' => date('Y-m-d'),
            'totalAmount' => $roomType->price * $totalRoom,
            'status' => 0,
            'payment_id' => null,
        ]);
        $totalAmount = $roomType->price * $totalRoom;
        foreach ($rooms as $room) {

            $booking = Booking::create([
                'room_id' => $room->room_id,
                'customer_id' => $customer->customer_id,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'adults' => $adults,
                'children' => $children,
                'totalPrice' => $roomType->price,
                'status' => 0,
            ]);
            $detailReceipt = $booking->receipts()->attach($receipt->receipt_id, ['price' => $roomType->price]);
            $room->status = 1;
            $room->save();
        }
        $receipt->totalAmount = $totalAmount;
        $receipt->save();
        //===================================================================================================
        return redirect('/');
    }
}
