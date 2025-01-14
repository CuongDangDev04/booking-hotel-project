@extends('user.user')
@section('title', 'Phòng')

@section('content')
<style>
    .carousel-item img {
        height: 500px;
        object-fit: cover;
    }

    .card {
        margin-top: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .list-group-item {
        font-size: 1.1rem;
    }

    .btn-block {
        font-size: 1.2rem;
        padding: 10px;
    }

    .room-info,
    .service-info {
        /* display: none; */
        /* Ẩn bảng thông tin ban đầu */

        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }



    .room-info td {
        padding: 10px;
    }

    .room-info td:first-child {
        font-weight: bold;
        background-color: #e9ecef;
    }

    .booking-form {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .booking-form h4 {
        margin-bottom: 15px;
        font-weight: bold;
    }

    .booking-form .form-label {
        font-weight: 500;
    }

    .booking-form .btn {
        background-color: #ff9900;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
    }

    .booking-form .btn:hover {
        background-color: #cc7a00;
    }

    .card {
        border-radius: 10px;
    }

    .footer {
        margin-top: 5rem !important;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">
            <div id="roomCarousel" class="carousel slide mb-4" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/room-1.jpg') }}" class="d-block w-100" alt="{{ $roomType->name }}">
                    </div>
                </div>
            </div>

            <div class="room-info mb-2">
                <h3 class="" style="cursor:pointer; user-select: none;" onclick="toggleRoomInfo()">Thông tin</h3>

                <table class="room-info-table table table-bordered table-hover table-striped">
                    <tbody>
                        <tr>
                            <td><strong>Price</strong></td>
                            <td>${{ $roomType->price }}/Day</td>
                        </tr>
                        <tr>
                            <td><strong>Capacity</strong></td>
                            <td>{{ $roomType->occupancy }}</td>
                        </tr>
                        <tr>
                            <td><strong>Available</strong></td>
                            <td>{{ $roomType->available ? 'Yes' : 'No' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="service-info">
                <h3 class="" style="cursor:pointer; user-select: none;" onclick="toggleRoomService()">Dịch vụ</h3>

                <table class="room-service-table table table-bordered table-hover table-striped">
                    <tbody>
                        @foreach($roomType->services as $service)
                        <tr>
                            <td><strong>{{$service->name}}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <h1 class="mb-3">{{ $roomType->name }}</h1>
            <p>{{$roomType->description}}</p>
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="m-0 list-unstyled">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="booking-form">
                <h4>Book This Room</h4>
                <form action="{{route('booking.room')}}" method="POST">
                    @csrf <!-- Laravel CSRF token -->
                    <input type="hidden" name="room_id" value="{{$roomType->roomType_id}}">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Tên</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your firstname" value="{{ old('firstname') }}" require>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Họ</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your lastname" value="{{ old('lastname') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Điện thoại</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" value="{{ old('address') }}">
                    </div>
                    <div class="mb-3">
                        <label for="checkin" class="form-label">Ngày nhận phòng</label>
                        <input type="date" id="check_in" name="checkin" class="form-control" min={{$today}} value="{{ old('checkin') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">Ngày trả phòng</label>
                        <input type="date" id="check_out" name="checkout" class="form-control" min={{$today}} value="{{ old('checkout') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalRoom" class="form-label">Số lượng phòng</label>
                        <input type="number" id="totalRoom" name="totalRoom" class="form-control" value="{{ old('totalRoom') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="adults" class="form-label">Số Khách</label>
                        <select class="form-select" name="adults" value="{{ old('adults') }}">
                            <option selected value="0">Người lớn</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="children" value="{{ old('children') }}">
                            <option selected value="0">Trẻ em</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Confirm Booking</button>
                </form>

            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Comments</h3>
            <form>
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment</label>
                    <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
                </div>
                <style>
                    .star,
                    .star-disable {
                        font-size: 2rem;
                        cursor: pointer;
                        color: #ddd;
                        /* Màu mặc định của sao (xám nhạt) */
                        transition: color 0.2s ease-in-out;
                        /* Thêm hiệu ứng mượt mà khi thay đổi màu */
                    }

                    .card-rating {
                        user-select: none;
                    }

                    .star:hover,
                    .star.hover {
                        color: #ffb400;
                        /* Màu sáng của sao khi hover (vàng) */
                    }

                    .star.selected {
                        color: #ffb400;
                        /* Màu vàng cho các sao đã chọn */
                    }
                </style>
                <div class="mb-3">
                    <label for="rating" class="form-label m-0">Rating</label>
                    <div id="starRating" class="star-rating">
                        <span class="star star1" data-value="1">&#9733;</span>
                        <span class="star star2" data-value="2">&#9733;</span>
                        <span class="star star3" data-value="3">&#9733;</span>
                        <span class="star star4" data-value="4">&#9733;</span>
                        <span class="star star5" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" id="rating" name="rating" required>
                </div>
                <script>
                    const stars = document.querySelectorAll('.star');
                    const ratingInput = document.getElementById('rating');

                    // Khi hover vào sao
                    stars.forEach(star => {
                        star.addEventListener('mouseover', () => {
                            const value = parseInt(star.getAttribute('data-value'));
                            stars.forEach(s => {
                                if (parseInt(s.getAttribute('data-value')) <= value) {
                                    s.classList.add('hover'); // Ánh sáng các sao khi hover
                                } else {
                                    s.classList.remove('hover');
                                }
                            });
                        });

                        // Khi bỏ hover (khi chuột ra ngoài sao)
                        star.addEventListener('mouseleave', () => {
                            stars.forEach(s => {
                                s.classList.remove('hover');
                            });
                        });

                        // Khi click vào sao
                        star.addEventListener('click', () => {
                            const value = parseInt(star.getAttribute('data-value'));
                            ratingInput.value = value; // Lưu giá trị vào input hidden
                            stars.forEach(s => {
                                if (parseInt(s.getAttribute('data-value')) <= value) {
                                    s.classList.add('selected'); // Đánh dấu các sao đã chọn
                                } else {
                                    s.classList.remove('selected');
                                }
                            });
                        });
                    });
                </script>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
            <div class="mt-4">
                <h4>All Comments</h4>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Đại Nam</h5>
                        <div class="card-rating">
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span>
                            <span class="star-disable">&#9733;</span>
                        </div>
                        <p class="card-text">Địa điểm tuyệt vời, phòng ốc sạch sẽ</p>
                        <p class="card-text"><small class="text-muted">Posted on 12/1/2025</small></p>
                    </div>

                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Hải Mõm</h5>
                        <div class="card-rating">
                            <span class="star selected">&#9733;</span>
                            <span class="star-disable">&#9733;</span>
                            <span class="star-disable">&#9733;</span>
                            <span class="star-disable">&#9733;</span>
                            <span class="star-disable">&#9733;</span>
                        </div>
                        <p class="card-text">Cách âm hơi kém</p>
                        <p class="card-text"><small class="text-muted">Posted on 12/1/2025</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleRoomInfo() {
        $(".room-info-table").toggle();
    }

    function toggleRoomService() {
        $(".room-service-table").toggle();
    }
</script>
@endsection