@extends('admin.dashboard')

@section('title', 'Chi tiết Hóa đơn')

@section('content')
<div class="container">
    <h1 class="mb-4 title-manager-room">Chi tiết Hóa đơn #{{ $selectedReceipt->receipt_id }}</h1>
    <a class="btn btn-primary" href="{{ route('admin.receipts.export', [$selectedReceipt->receipt_id]) }}">Xuất hóa đơn</a>

    <p><strong>Ngày phát hành:</strong> {{ \Carbon\Carbon::parse($selectedReceipt->issueDate)->format('d/m/Y') }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($selectedReceipt->totalAmount, 2) }} VND</p>

    <p><strong>Trạng thái:</strong>
        @if ($selectedReceipt->status == 0)
        Chưa thanh toán
        @elseif ($selectedReceipt->status == 1)
        Đã thanh toán
        @else
        N/A
        @endif
    </p>

    <h3>Danh sách Booking</h3>
    <table class="table table-bordered table-striped">
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
            @foreach ($selectedReceipt->bookings as $booking)
            <tr>
                <td>{{ $booking->booking_id }}</td>
                <td>{{ $booking->customer ? $booking->customer->firstName . ' ' . $booking->customer->lastName : 'N/A' }}</td>
                <td>{{ $booking->room->roomNo ?? 'N/A' }}</td>
                <td>{{  \Carbon\Carbon::parse($booking->checkin)->format('d/m/Y') }}</td>
                <td>{{  \Carbon\Carbon::parse($booking->checkout)->format('d/m/Y')}}</td>
                <td>{{ number_format($booking->totalPrice, 2) }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Thông tin thanh toán</h3>
    @if ($selectedReceipt->payment)
    <p><strong>Hình thức thanh toán:</strong>
        @if ($selectedReceipt->payment->paymentMethod == 'credit_card')
        Thẻ tín dụng
        @elseif ($selectedReceipt->payment->paymentMethod == 'bank_transfer')
        Chuyển khoản ngân hàng
        @elseif ($selectedReceipt->payment->paymentMethod == 'counter_payment')
        Thanh toán tại quầy
        @else
        N/A
        @endif
    </p>
    <p><strong>Trạng thái thanh toán:</strong>
        @if ($selectedReceipt->payment->status == 0)
        Chưa thanh toán
        @elseif ($selectedReceipt->payment->status == 1)
        Đã thanh toán
        @else
        N/A
        @endif
    </p>
    @else
    <p>Chưa có thông tin thanh toán.</p>
    @endif

    <a href="{{ route('admin.receipts.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

@endsection

<style>
    .title-manager-room {
        font-size: 42px;
        font-weight: bold;
    }

    .container {
        margin-top: 50px;
    }

    .table {
        font-family: 'Arial', sans-serif;
        font-size: 14px;
        width: 100%;
        table-layout: fixed;
        /* Giúp bảng tự động điều chỉnh cột */
    }

    .table th,
    .table td {
        word-wrap: break-word;
        word-break: break-all;
        padding: 8px;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table-dark {
        background-color: #343a40;
        color: white;
    }

    .pagination-wrapper {
        margin-top: 20px;
    }

    .btn-secondary {
        margin-top: 20px;
    }

    /* Cải thiện responsive cho bảng */
    @media (max-width: 768px) {
        .table {
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 8px;
        }
    }
</style>