@extends('admin.dashboard')

@section('title', 'Quản lí Đặt Phòng')

@section('content')
<div class="container">
    <h1 class="mb-4 title-manager-room">Quản lý Đặt Phòng</h1>

    <!-- Bookings Table -->
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th><a href="{{ route('admin.bookings.index', ['sort_by' => 'booking_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">ID
                    <i class="fa fa-arrow-up"></i>
                    <i class="fa fa-arrow-down"></i>
                </a></th>
                <th>Tên Khách Hàng
                   
                </a></th>
                <th><a href="{{ route('admin.bookings.index', ['sort_by' => 'room_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Số phòng
                    <i class="fa fa-arrow-up"></i>
                    <i class="fa fa-arrow-down"></i>
                </a></th>
                <th><a href="{{ route('admin.bookings.index', ['sort_by' => 'checkin', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Ngày Nhận Phòng
                    <i class="fa fa-arrow-up"></i>
                    <i class="fa fa-arrow-down"></i>
                </a></th>
                <th><a href="{{ route('admin.bookings.index', ['sort_by' => 'checkout', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Ngày Trả Phòng
                    <i class="fa fa-arrow-up"></i>
                    <i class="fa fa-arrow-down"></i>
                </a></th>
                <th><a  >Số người
                     
                </a></th>
                <th><a>Tổng Tiền
                    
                </a></th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->booking_id }}</td>
                <td>{{ $booking->customer ? $booking->customer->firstName . ' ' . $booking->customer->lastName : 'Chưa có thông tin khách hàng' }}</td>
                <td>{{ $booking->room->roomNo ?? 'Chưa có thông tin phòng' }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->checkin)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->checkout)->format('d/m/Y H:i') }}</td>
                <td>{{ $booking->adults + $booking->children }}</td>
                <td>{{ number_format($booking->totalPrice, 2) }} VND</td>
                <td>
                    @switch($booking->status)
                        @case(0)
                            Chờ xác nhận
                            @break
                        @case(1)
                            Đã xác nhận
                            @break
                        @case(2)
                            Đã hủy
                            @break
                        @default
                            Không xác định
                    @endswitch
                </td>
                <td>
                    <!-- Update Status Button -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBookingModal{{ $booking->booking_id }}">
                        Cập Nhật Trạng Thái
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.bookings.destroy', $booking->booking_id) }}" method="POST" style="display:inline-block;" id="delete-form-{{ $booking->booking_id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteBooking('{{ $booking->booking_id }}')">Xóa</button>
                    </form>
                </td>
            </tr>

            <!-- Update Status Modal -->
            <div class="modal fade" id="editBookingModal{{ $booking->booking_id }}" tabindex="-1" aria-labelledby="editBookingModalLabel{{ $booking->booking_id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.bookings.updateStatus', $booking->booking_id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Cập Nhật Trạng Thái Đặt Phòng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select name="status" class="form-control" required>
                                        <option value="0" {{ $booking->status == 0 ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="1" {{ $booking->status == 1 ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="2" {{ $booking->status == 2 ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteBooking(bookingId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa đặt phòng này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + bookingId).submit();
            }
        });
    }
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
    }
    .table-dark {
        background-color: #343a40;
        color: white;
    }
</style>
