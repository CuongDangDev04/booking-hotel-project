<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\DetailReceipt;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookingRoom(Request $request)
    {
        $user_id = null;
        if (auth()->check()) {
            $user_id = auth()->id(); // Lấy ID người dùng đã đăng nhập
        }
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
        if ($guests < 1) {
            $errors['numGuest'] = 'Phải có ít nhất 1 khách hàng';
        }
        $maxGuests = $roomType->occupancy * $totalRoom; // Tổng số người tối đa cho tất cả các phòng đã đặt
        if ($guests > $maxGuests) {
            $errors['guests'] = 'Số lượng khách vượt quá khả năng chứa của phòng.';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $roomOfRoomType = Room::where('roomType_id', $roomType->roomType_id)->get();
        foreach ($roomOfRoomType as $room) {
            $checkroom = Booking::where('room_id', $room->room_id)
                ->where(function ($query) use ($checkin, $checkout) {
                    $query->whereBetween('checkin', [$checkin, $checkout])
                        ->orWhereBetween('checkout', [$checkin, $checkout])
                        ->orWhereRaw('? BETWEEN checkin AND checkout', [$checkin])
                        ->orWhereRaw('? BETWEEN checkin AND checkout', [$checkout]);
                })
                ->exists();

            if (!$checkroom) {
                $room->status = 0;
                $room->save();
            }
        }

        $availableRooms = Room::where('roomType_id', $roomType->roomType_id)->where('status', 0)->count();
        if ($availableRooms >= $totalRoom) {
            $rooms = Room::where('roomType_id', $roomType->roomType_id)->where('status', 0)->limit($totalRoom)->get();
            $customer = Customer::create([
                'firstName' => $firstname,
                'lastName' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            ]);
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
                    'user_id' => $user_id,
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
        } else {
            return back()->withErrors(['room' => 'Số phòng khả dụng: ' . $availableRooms]);
        }

        $_checkin = strtotime($checkin);
        $_checkout = strtotime($checkout);
        $daysOfWeek = [
            "Chủ Nhật",
            "Thứ 2",
            "Thứ 3",
            "Thứ 4",
            "Thứ 5",
            "Thứ 6",
            "Thứ 7"
        ];
        $dayOfWeek_checkin = $daysOfWeek[date("w", $_checkin)];
        $dayOfWeek_checkout = $daysOfWeek[date("w", $_checkout)];

        $day_checkin = date("d", $_checkin);
        $day_checkout = date("d", $_checkout);

        $month_checkin = date("m", $_checkin);
        $month_checkout = date("m", $_checkout);

        $year_checkin = date("Y", $_checkin);
        $year_checkout = date("Y", $_checkout);

        $totalDays = $_checkout - $_checkin;
        $totalDays = $totalDays / (60 * 60 * 24);

        //===================================================================================================
        return view('user.payment-user', [
            'customer' => $customer,
            'receipt' => $receipt,
            'rooms' => $rooms,
            'roomType' => $roomType,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'totalRoom' => $totalRoom,
            'adults' => $adults,
            'children' => $children,
            'dayOfWeek_checkin' => $dayOfWeek_checkin,
            'dayOfWeek_checkout' => $dayOfWeek_checkout,
            'day_checkin' => $day_checkin,
            'day_checkout' => $day_checkout,
            'month_checkin' => $month_checkin,
            'month_checkout' => $month_checkout,
            'year_checkin' => $year_checkin,
            'year_checkout' => $year_checkout,
            'totalDays' => $totalDays

        ]);
    }
    public function payment(Request $request)
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $receipt_id = (int) $request->input('receipt_id');
        $paymentMethod = $request->input('payment_method');
        if ($paymentMethod == 'cash') {
            $receipt = Receipt::find($receipt_id);
            return redirect('/')->with('success', 'Đặt phòng thành công! Hãy chuẩn bị số tiền tương ứng khi nhận phòng.');
        } else if ($paymentMethod == 'bank_transfer' || $paymentMethod == 'credit_card') {
            $receipt = Receipt::find($receipt_id);
            // dd($receipt);
            return view('user.paying-user', [
                'receipt' => $receipt,
                'paymentMethod' => $paymentMethod
            ]);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $receipt_id = $request->input('receipt_id');
        $paymentMethod = $request->input('paymentMethod');

        $receipt = Receipt::find($receipt_id);

        $payment = Payment::create([
            'receipt_id' => $receipt_id,
            'paymentDate' => date('Y-m-d'),
            'paymentMethod' => $paymentMethod,
            'status' => 1,
        ]);

        $receipt->status = 1;
        $receipt->save();

        $detailReceipt = DetailReceipt::find('receipt_id', $receipt_id);

        foreach ($detailReceipt as $detail) {
            $booking = Booking::find($detail->booking_id);

            if ($booking) {
                $booking->status = 1;
                $booking->save();
            }
        }

        // $booking = Booking::whereHas('receipts', function ($query) use ($receipt_id) {
        //     $query->where('detail_receipts.receipt_id', $receipt_id);
        // })->first();

        // if ($booking) {
        //     $booking->status = 1;
        //     $booking->save();
        // }

        return redirect('/')->with('success', 'Đặt phòng thành công! Hãy kiểm tra email của bạn để xem thông tin chi tiết.');
    }
}
