@extends('user.user')
@section('title', 'Thanh toán')
@section('content')

<style>
    .qr-payment-container {
        text-align: center;
        margin-top: 50px;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .qr-payment-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .qr-code-image img {
        width: 200px;
        height: 200px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: #fff;
    }

    .qr-note {
        margin-top: 20px;
        font-size: 16px;
        color: #666;
    }

    .payment-container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .payment-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-group .small {
        font-size: 12px;
        color: #888;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: var(--primary);
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .footer {
        margin-top: 100px;
        padding-top: 0;
    }
</style>
<?php

?>
@if($paymentMethod == 'bank_transfer')
<div class="qr-payment-container">
    <p class="qr-payment-title">Quét mã QR để thanh toán</p>
    <div class="qr-code-image">
        <img src="{{ $qrCodeUrl }}" alt="QR Code">
    </div>
    <p class="qr-note">Vui lòng sử dụng ứng dụng ngân hàng để quét mã QR và hoàn tất thanh toán.</p>
    <p class="text-center text-primary">Ấn tiếp tục nếu đã thanh toán</p>
    <form action="{{route('payment.success')}}" method="POST">
        @csrf

        <input type="hidden" name="receipt_id" value="{{$receipt->receipt_id}}">
        <input type="hidden" name="paymentMethod" value="{{$paymentMethod}}">
        <button type="submit" class="btn btn-primary">Tiếp tục</button>
    </form>
</div>
@else($paymentMethod == 'credit_card')
<div class="container d-flex justify-content-center mt-5">

    <div class="payment-container w-100 bg-dark">
        <h2 class="text-primary">Thanh Toán Bằng Thẻ Tín Dụng</h2>
        <div class="card-container w-100 d-flex justify-content-between">
            <img src="{{ asset('img/credit1.webp') }}" alt="" class="bank-img">
            <img src="{{ asset('img/credit2.webp') }}" alt="" class="bank-img">
            <img src="{{ asset('img/credit3.webp') }}" alt="" class="bank-img">
            <img src="{{ asset('img/credit4.webp') }}" alt="" class="bank-img">

        </div>
        <form action="{{route('payment.success')}}" method="POST">
            @csrf
            <input type="hidden" name="receipt_id" value="{{$receipt->receipt_id}}">
            <input type="hidden" name="paymentMethod" value="{{$paymentMethod}}">

            <div class="form-group">
                <label for="card-name" class="text-primary">Ví</label>
                <input type="text" id="card-name" name="card_name" placeholder="Enter cardholder name" required>
            </div>
            <div class="form-group">
                <label for="card-number" class="text-primary">Số thẻ</label>
                <input type="text" id="card-number" name="card_number" placeholder="Enter card number" maxlength="16" required>
            </div>
            <div class="form-group">
                <label for="expiry-date" class="text-primary">Ngày hết hạn</label>
                <input type="date" id="expiry-date" name="expiry_date" placeholder="MM/YY" maxlength="5" required>
            </div>
            <div class="form-group">
                <label for="cvv" class="text-primary">Mã bảo mật</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" maxlength="3" required>
            </div>
            <button type="submit" class="btn-submit">Pay Now</button>
        </form>
    </div>
</div>
@endif
@endsection