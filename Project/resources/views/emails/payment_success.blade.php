<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
</head>
<body>
    <h1>Chúc mừng bạn đã thanh toán thành công!</h1>
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Đây là chi tiết đơn hàng của bạn:</p>
    
    <ul>
        <li><strong>Hóa đơn ID:</strong> {{ $receipt->receipt_id }}</li>
        <li><strong>Ngày phát hành:</strong> {{ \Carbon\Carbon::parse($receipt->issueDate)->format('d/m/Y') }}</li>
        <li><strong>Tổng tiền:</strong> {{ number_format($receipt->totalAmount, 2) }} VND</li>
        <li><strong>Trạng thái thanh toán:</strong>
            @if ($receipt->payment && $receipt->payment->status == 1)
                Đã thanh toán
            @else
                Chưa thanh toán
            @endif
        </li>
    </ul>
    
    <h3>Danh sách Booking</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Phòng</th>
                <th>Ngày nhận phòng</th>
                <th>Ngày trả phòng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipt->bookings as $booking)
            <tr>
                <td>{{ $booking->booking_id }}</td>
                <td>{{ $booking->customer ? $booking->customer->lastName . ' ' . $booking->customer->firstName : 'N/A' }}</td>
                <td>{{ $booking->room->roomNo ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->checkin)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->checkout)->format('d/m/Y') }}</td>
                <td>{{ number_format($booking->totalPrice, 2) }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>Hãy kiểm tra lại thông tin và tiếp tục với các bước tiếp theo.</p>
    
    <h3>Thông tin thanh toán</h3>
    @if ($receipt->payment)
        <p><strong>Hình thức thanh toán:</strong>
            @if ($receipt->payment->paymentMethod == 'credit_card')
            Thẻ tín dụng
            @elseif ($receipt->payment->paymentMethod == 'bank_transfer')
            Chuyển khoản ngân hàng
            @elseif ($receipt->payment->paymentMethod == 'counter_payment')
            Thanh toán tại quầy
            @else
            N/A
            @endif
        </p>
    @else
        <p>Chưa có thông tin thanh toán.</p>
    @endif

</body>
</html>
