<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Chi Tiết</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif !important;
        background-color: #f2f2f2;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .invoice-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #2a3d66;
        margin-bottom: 10px;
    }

    .invoice-header .date {
        font-size: 16px;
        color: #666;
        font-weight: 500;
    }

    .invoice-body p {
        font-size: 16px;
        color: #333;
        margin: 8px 0;
    }

    .invoice-body .status {
        font-weight: 600;
        color: #28a745;
    }

    h3 {
        font-size: 20px;
        color: #2a3d66;
        font-weight: 600;
        margin-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        text-align: left;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #e0e0e0;
    }

    .table th {
        background-color: #2a3d66;
        color: white;
        font-weight: 600;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .col-md-6 {
        flex: 1;
        padding: 15px;
        box-sizing: border-box;
    }

    .col-md-6.text-md-end {
        text-align: right;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
        }

        .invoice-header .date {
            font-size: 14px;
        }

        h3 {
            font-size: 18px;
        }

        .table th,
        .table td {
            padding: 10px;
        }

        .col-md-6.text-md-end {
            text-align: left;
        }
    }
</style>


</head>

<body>

    <div class="container">
        <div class="invoice">
            <!-- Invoice Header -->
            <div class="invoice-header">
                <h1>Chi tiết Hóa đơn #{{ $receipt->receipt_id }}</h1>
                <p class="date">{{ \Carbon\Carbon::parse($receipt->issueDate)->format('d/m/Y') }}</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Tổng tiền:</strong> {{ number_format($receipt->totalAmount, 2) }} VND</p>
                    <p><strong>Trạng thái:</strong>
                        @if ($receipt->status == 0) <span class="status">Chưa thanh toán</span>
                        @elseif ($receipt->status == 1) <span class="status">Đã thanh toán</span>
                        @else <span class="status">N/A</span> @endif
                    </p>
                    @foreach ($receipt->bookings as $booking)
                    <p><strong>Ngày nhận phòng: </strong>{{  \Carbon\Carbon::parse($booking->checkin)->format('d/m/Y') }}</p>
                    <p><strong>Ngày trả phòng: </strong>{{  \Carbon\Carbon::parse($booking->checkout)->format('d/m/Y')}}</p>
                    @endforeach
                </div>
                <div class="col-md-6 text-md-end">
                    <h3>Danh sách Booking</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Phòng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receipt->bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customer ? $booking->customer->firstName . ' ' . $booking->customer->lastName : 'N/A' }}</td>
                                <td>{{ $booking->room->roomNo ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <h3 class="mt-4">Thông tin thanh toán</h3>
            @if ($receipt->payment)
            <p><strong>Hình thức thanh toán:</strong>
                @if ($receipt->payment->paymentMethod == 'credit_card') Thẻ tín dụng
                @elseif ($receipt->payment->paymentMethod == 'bank_transfer') Chuyển khoản ngân hàng
                @elseif ($receipt->payment->paymentMethod == 'counter_payment') Thanh toán tại quầy
                @else N/A @endif
            </p>
            <p><strong>Trạng thái thanh toán:</strong>
                @if ($receipt->payment->status == 0) Chưa thanh toán
                @elseif ($receipt->payment->status == 1) Đã thanh toán
                @else N/A @endif
            </p>
            @endif
        </div>
    </div>

</body>

</html>