@extends('dashboard')

@section('content-header', 'Thông tin người dùng')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Thông Tin Khách Hàng</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Thông tin khách hàng
                </div>
                <div class="card-body">
                    <p><strong>Tên:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Ngày đăng ký:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection