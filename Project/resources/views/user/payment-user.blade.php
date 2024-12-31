@extends('user.user')
@section('content')
<style>
    .footer {
        margin-top: 90px;
        padding-top: 0;
    }


    .progress-bar {
        display: flex;
        justify-content: space-between;
        max-width: 800px;
        width: 100%;
        background-color: transparent;
    }

    .step {
        display: flex;
        align-items: center;
        text-align: center;
        flex: 1;
        position: relative;
    }

    .step .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ccc;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 16px;
    }

    .step.completed .circle {
        background-color: var(--primary);
    }

    .step.active .circle {
        background-color: var(--primary);
        border: 2px solid var(--primary);
        ;
    }

    .step p {
        margin: auto !important;
        font-size: 14px;
        color: #333;
    }

    .line {
        height: 2px;
        background-color: #ccc;
        flex: 1;
        margin: auto 0.5rem;
    }

    .step.completed+.line {
        background-color: var(--primary);
    }

    .detail-booking,
    .price-summary {
        border: 1px solid var(--primary);
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .detail-title,
    .price-summary .title {
        border-bottom: 1px solid var(--primary);
        background-color: #ff9800;
        color: #fff;
        margin: 0;
        border-radius: 10px 10px 0 0;
        font-size: 1.2rem;
    }

    .detail-booking .p-2,
    .price-summary .p-2 {
        padding: 1rem;
    }

    .checkin,
    .checkout,
    .length-stay {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }

    .checkin,
    .checkout {
        border-bottom: 1px dashed var(--primary);
    }

    .checkin p,
    .checkout p,
    .length-stay p {
        margin: 0;
        font-size: 1rem;
    }

    .length-stay p {
        font-weight: 500;
    }

    .price-summary ul {
        margin: 0;
        padding: 0 1.5rem;
    }

    .price-summary li {
        font-size: 1rem;
        padding: 0.5rem 0;
    }

    .total-amount {
        font-weight: bold;
        font-size: 1.2rem;
        border-top: 1px solid var(--primary);
        margin-top: 1rem;
    }

    .container {
        max-width: 1200px;
    }
</style>
<div class="d-flex progress-container justify-content-center m-5">
    <div class="progress-bar flex-row">
        <div class="step completed">
            <div class="circle">1</div>
            <p>Chọn phòng</p>
        </div>
        <div class="line"></div>
        <div class="step active">
            <div class="circle">2</div>
            <p>Nhập thông tin</p>
        </div>
        <div class="line"></div>
        <div class="step">
            <div class="circle">3</div>
            <p>Xác nhận đặt phòng</p>
        </div>
    </div>
</div>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-4">
            <div class="detail-booking mb-3">
                <h6 class="detail-title p-2 text-center">Chi tiết đặt phòng</h6>
                <div class="checkin">
                    <p class="fw-bold">Ngày nhận phòng:</p>
                    <p><span>{{$dayOfWeek_checkin}}</span>, <span>{{$day_checkin}} Tháng {{$month_checkin}}</span>, <span>{{$year_checkin}}</span></p>
                </div>
                <div class="checkout">
                    <p class="fw-bold">Ngày trả phòng:</p>
                    <p><span>{{$dayOfWeek_checkout}}</span>, <span>{{$day_checkout}} Tháng {{$month_checkout}}</span>, <span>{{$year_checkout}}</span></p>
                </div>
                <div class="length-stay">
                    <p class="fw-bold">Tổng thời gian lưu trú:</p>
                    <p>{{$totalDays}} ngày</p>
                </div>
            </div>
            <div class="price-summary fs-4">
                <h6 class="title p-2 text-center">Tóm tắt chi phí</h6>
                <ul class="list-unstyled p-3 mb-0">
                    @foreach($rooms as $room)
                    <li class="d-flex justify-content-between"><span>{{$roomType->name}}: </span><span>{{$roomType->price}}</span></li>
                    @endforeach
                </ul>
                <p class="total-amount d-flex justify-content-between p-3 pt-0">
                    <span>Tổng cộng: </span>
                    <span>{{$roomType->price * $totalDays * count($rooms)}}</span>
                </p>
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="text-center">Thanh Toán</h1>
            <form action="{{route('payment.room')}}" method="post">
                @csrf
                <input type="hidden" name="receipt_id" value="{{$receipt->receipt_id}}">
                <h3>Thông tin khách hàng</h3>
                <div class="form-group mb-3">
                    <label for="firstname">Tên</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Nhập tên" value="{{ old('firstname') ?? $customer->firstName }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="lastname">Họ</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nhập họ" value="{{ old('lastname') ?? $customer->lastName }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') ?? $customer->email }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone') ?? $customer->phone}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" value="{{ old('address') ?? $customer->address}}" required>
                </div>

                <h3>Thông tin thanh toán</h3>

                <div class="form-group mb-3">
                    <label for="payment_method">Phương thức thanh toán</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="credit_card">Thẻ tín dụng</option>
                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                        <option value="cash" selected>Thanh toán tại quầy</option>
                    </select>
                </div>



                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </form>
        </div>
    </div>
</div>

@endsection