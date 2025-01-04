<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Chi Tiết</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', 'Arial', sans-serif !important;
        }

        h1,
        h2,
        p,
        td,
        th {
            font-family: 'Roboto', 'Arial', sans-serif !important;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 36px;
            font-weight: 600;
            color: #2a3d66;
        }

        .invoice-header .date {
            font-size: 18px;
            color: #888;
            margin-top: 5px;
        }

        .invoice-body {
            margin-top: 30px;
        }

        .invoice-body p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .invoice-body .status {
            font-weight: 600;
            color: #28a745;
        }

        .table th,
        .table td {
            text-align: left;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #2a3d66;
            color: white;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        h3 {
            font-size: 24px;
            margin-top: 30px;
            color: #2a3d66;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        /* Button Style */
        .btn {
            background-color: #2a3d66;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #1d2c47;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .invoice-header h1 {
                font-size: 28px;
            }

            .container {
                padding: 20px;
            }

            .invoice-body p {
                font-size: 14px;
            }

            .table th,
            .table td {
                padding: 10px;
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

            <!-- Invoice Body -->
            <div class="invoice-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>Chữ viết tiếng Việt: ă â ê ô ơ ư đ, dấu sắc, huyền, hỏi, ngã, nặng.
                        </p>
                        <p><strong>Tổng tiền:</strong> {{ number_format($receipt->totalAmount, 2) }} VND</p>
                        <p><strong>Trạng thái:</strong>
                            @if ($receipt->status == 0) <span class="status">Chưa thanh toán</span>
                            @elseif ($receipt->status == 1) <span class="status">Đã thanh toán</span>
                            @else <span class="status">N/A</span> @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h3>Danh sách Booking</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Phòng</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt->bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_id }}</td>
                                    <td>{{ $booking->customer ? $booking->customer->firstName . ' ' . $booking->customer->lastName : 'N/A' }}</td>
                                    <td>{{ $booking->room->roomNo ?? 'N/A' }}</td>
                                    <td>{{ number_format($booking->totalPrice, 2) }} VND</td>
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
    </div>

</body>

</html>