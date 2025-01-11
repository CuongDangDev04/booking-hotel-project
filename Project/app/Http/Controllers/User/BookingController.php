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
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    protected $vietQRProvider;
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
                'totalAmount' => $roomType->price * $totalRoom * $totalDays,
                'status' => 0,
                'payment_id' => null,
            ]);
            $totalAmount = $roomType->price * $totalRoom * $totalDays;
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
                $detailReceipt = $booking->receipts()->attach($receipt->receipt_id, ['price' => $roomType->price * $totalDays]);
                $room->status = 1;
                $room->save();
            }
            $receipt->totalAmount = $totalAmount;
            $receipt->save();
        } else {
            return back()->withErrors(['room' => 'Số phòng khả dụng: ' . $availableRooms]);
        }



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

        $receipt = Receipt::find($receipt_id);

        if ($paymentMethod == 'cash') {
            return redirect('/')->with('success', 'Đặt phòng thành công! Hãy chuẩn bị số tiền tương ứng khi nhận phòng.');
        } else if ($paymentMethod == 'bank_transfer' || $paymentMethod == 'credit_card') {
            $amount = $receipt->totalAmount;
            // dump($receipt);
            $qrResponse = Http::post('https://api.vietqr.io/v2/generate', [
                'accountNo' => '0326626110',
                'accountName' => 'NGUYEN DAI NAM',
                'bankCode' => 'MB',
                'amount' => intval($amount),
                "addInfo" => "Thanh toán hóa đơn $receipt_id",
                "acqId" => 970422,
                "template" => "compact",
            ]);
            // dd($qrResponse->json());
            if ($qrResponse->successful()) {
                $qrCodeUrl = $qrResponse->json()['data']['qrDataURL'];
                return view('user.paying-user', [
                    'receipt' => $receipt,
                    'paymentMethod' => $paymentMethod,
                    'qrCodeUrl' => $qrCodeUrl,
                ]);
            } else {
                return redirect()->back()->with('error', 'Không thể tạo mã QR. Vui lòng thử lại!');
            }
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

        $detailReceipt = DetailReceipt::where('receipt_id', $receipt_id)->get();

        foreach ($detailReceipt as $detai) {
            $booking = Booking::find($detai->booking_id);
            if ($booking) {
                $booking->status = 1;
                $booking->save();
            }
        }


        return redirect('/')->with('success', 'Đặt phòng thành công! Hãy kiểm tra email của bạn để xem thông tin chi tiết.');
    }
    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);


        $detailReceipt = DetailReceipt::where('booking_id', $booking->booking_id)->first();


        if ($detailReceipt) {
            $receipt_id = $detailReceipt->receipt_id;
            $detailReceipts = DetailReceipt::where('receipt_id', $receipt_id)->get();
            $receipt = Receipt::findOrFail($receipt_id);
            $refund = 0;
            if ($detailReceipts->count() > 1) {
                $refund += $detailReceipt->price;
                $receipt->totalAmount -= $refund;
                $receipt->save();
                $booking->delete();
            } else {
                $booking->delete();
                $receipt->delete();
            }
        }

        $booking->delete();

        return redirect()->route('dashboard.bookings');
    }
}
