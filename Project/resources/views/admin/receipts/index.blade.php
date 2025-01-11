@extends('admin.dashboard')

@section('title', 'Quản lý Hóa đơn')

@section('content')
<div class="container">
    <h1 class="mb-4 title-manager-room">Quản lý Hóa đơn</h1>

    <div class="row">
        <!-- Danh sách hóa đơn -->
        <div class="col-md-12">
            <h2>Danh sách Hóa đơn</h2>
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <a href="{{ route('admin.receipts.index', ['sort_by' => 'receipt_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                ID
                                <span class="sort-icons">
                                    <i class="fa fa-arrow-up {{ $sortBy === 'receipt_id' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                                    <i class="fa fa-arrow-down {{ $sortBy === 'receipt_id' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.receipts.index', ['sort_by' => 'issueDate', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Ngày phát hành
                                <span class="sort-icons">
                                    <i class="fa fa-arrow-up {{ $sortBy === 'issueDate' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                                    <i class="fa fa-arrow-down {{ $sortBy === 'issueDate' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.receipts.index', ['sort_by' => 'totalAmount', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Tổng tiền
                                <span class="sort-icons">
                                    <i class="fa fa-arrow-up {{ $sortBy === 'totalAmount' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                                    <i class="fa fa-arrow-down {{ $sortBy === 'totalAmount' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </a>
                        </th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th>
                        <th>Chi tiết</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                    <tr>
                        <td>{{ $receipt->receipt_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($receipt->issueDate)->format('d/m/Y') }}</td>
                        <td>{{ number_format($receipt->totalAmount, 2) }} VND</td>
                        <td>
                            @if ($receipt->status == 0)
                            Chưa thanh toán
                            @elseif ($receipt->status == 1)
                            Đã thanh toán
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            @if ($receipt->bookings->isNotEmpty())
                            {{ $receipt->bookings->first()->customer ? $receipt->bookings->first()->customer->firstName . ' ' . $receipt->bookings->first()->customer->lastName : 'N/A' }}
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.receipts.show', ['id' => $receipt->receipt_id]) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                        </td>
                        <td>
                            <!-- Nút Xóa -->
                            <form action="{{ route('admin.receipts.destroy', ['id' => $receipt->receipt_id]) }}" method="POST" style="display:inline-block;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $receipts->links() }}
            </div>
            <style>
                .pagination .text-gray-700:first-child {
                    display: none !important;
                }
            </style>

        </div>

        <!-- Chi tiết hóa đơn -->
        @if ($selectedReceipt)
        <div class="col-md-12">
            <h2>Chi tiết Hóa đơn #{{ $selectedReceipt->receipt_id }}</h2>
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
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedReceipt->bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_id }}</td>
                        <td>{{ $booking->customer ? $booking->customer->firstName . ' ' . $booking->customer->lastName : 'N/A' }}</td>
                        <td>{{ $booking->room->roomNo ?? 'N/A' }}</td>
                        <td>{{ number_format($booking->totalPrice, 2) }} VND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Thông tin thanh toán</h3>
            @if ($selectedReceipt->payment)
            <p><strong>Hình thức thanh toán:</strong> {{ $selectedReceipt->payment->paymentMethod }}</p>
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
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-form button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Hiển thị SweetAlert xác nhận
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa hóa đơn này?',
                    text: "Hành động này không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu người dùng nhấn 'Xóa', submit form để xóa hóa đơn
                        this.closest('form').submit();
                    }
                });
            });
        });
    });
</script>

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
    }

    .table-dark {
        background-color: #343a40;
        color: white;
    }

    .pagination-wrapper {
        margin-top: 20px;
    }

    .sort-icons {
        margin-left: 5px;
    }

    .sort-icons i {
        font-size: 12px;
        color: #ccc;
    }

    .sort-icons i.active {
        color: #000;
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