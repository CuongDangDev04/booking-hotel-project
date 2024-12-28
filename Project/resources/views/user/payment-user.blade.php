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
        border-radius: 5px;
        background-color: #fff;
    }

    .detail-title,
    .price-summary .title {
        border-bottom: 1px solid var(--primary);
        background-color: #ffdca8;
        margin: 0;
    }

    .checkin,
    .checkout,
    .length-stay {
        margin: 0.5rem 0;
        padding-left: 1rem;
    }

    .checkin,
    .checkout {
        border-bottom: 1px solid var(--primary);
    }

    .checkin p,
    .checkout p,
    .length-stay p {
        margin: 0;
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
                    <p><span>Thứ 2</span>, <span>30 Tháng 12</span>, <span>2024</span></p>
                </div>
                <div class="checkout">
                    <p class="fw-bold">Ngày trả phòng:</p>
                    <p><span>Thứ 2</span>, <span>30 Tháng 12</span>, <span>2024</span></p>
                </div>
                <div class="length-stay">
                    <p class="fw-bold">Tổng thời gian lưu trú:</p>
                    <p>1 ngày</p>
                </div>
            </div>
            <div class="price-summary fs-4">
                <h6 class="title p-2 text-center">Tóm tắt chi phí</h6>
                <ul class="list-unstyled p-3 mb-0">
                    <li class="d-flex justify-content-between"><span>Số phòng 1: </span><span>100</span></li>
                    <li class="d-flex justify-content-between"><span>Số phòng 2: </span><span>100</span></li>
                </ul>
                <p class="total-amount d-flex justify-content-between p-3 pt-0">
                    <span>Price: </span>
                    <span>200</span>
                </p>
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="text-center">Thanh Toán</h1>
            <form method="post">
                @csrf
                <h3>Thông tin khách hàng</h3>
                <div class="form-group mb-3">
                    <label for="name">Tên</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" value="{{ old('address') }}" required>
                </div>

                <h3>Thông tin thanh toán</h3>
                <div class="form-group mb-3">
                    <label for="amount">Tổng cộng</label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter amount" value="{{ old('amount') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="payment_method">Phương thức thanh toán</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>

                <div id="credit_card_info" class="payment-info" style="display: none;">
                    <h4>Credit Card Information</h4>
                    <div class="form-group mb-3">
                        <label for="card_number">Card Number</label>
                        <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Enter card number">
                    </div>
                    <div class="form-group mb-3">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="text" name="expiry_date" id="expiry_date" class="form-control" placeholder="MM/YY">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cvv">CVV</label>
                        <input type="text" name="cvv" id="cvv" class="form-control" placeholder="Enter CVV">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        var creditCardInfo = document.getElementById('credit_card_info');
        if (this.value === 'credit_card') {
            creditCardInfo.style.display = 'block';
        } else {
            creditCardInfo.style.display = 'none';
        }
    });
</script>
@endsection