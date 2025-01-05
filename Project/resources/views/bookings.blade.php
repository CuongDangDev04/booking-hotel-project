@extends('dashboard')

@section('content-header', 'Lịch sử đặt phòng')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Lịch Sử Đặt Phòng</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Lịch sử đặt phòng
                </div>
                <div class="card-body">
                    @if($bookings->isEmpty())
                    <p>Bạn chưa có đặt phòng nào.</p>
                    @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Phòng</th>
                                <th>Ngày nhận phòng</th>
                                <th>Ngày trả phòng</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->checkin }}</td>
                                <td>{{ $booking->checkout }}</td>
                                <td>{{ number_format($booking->totalPrice, 0, ',', '.') }} VND</td>
                                <td>
                                    @if($booking->status == 0)
                                    Đang chờ
                                    @elseif($booking->status == 1)
                                    Đã xác nhận
                                    @else
                                    Đã hủy
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection