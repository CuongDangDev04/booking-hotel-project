@extends('user.user')
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
        <script>
            function toggleRoomInfo() {
                $(".room-info-table").toggle();
            }

            function toggleRoomService() {
                $(".room-service-table").toggle();
            }
        </script>
        <div class="col-md-4">
            <h1 class="mb-3">{{ $roomType->name }}</h1>
            <p>{{$roomType->description}}</p>
            <div class="booking-form">
                <h4>Book This Room</h4>
                <form action="/book-room" method="POST">
                    @csrf <!-- Laravel CSRF token -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check-in Date</label>
                        <input type="date" id="check_in" name="check_in" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="guest_count" class="form-label">Number of Guests</label>
                        <input type="number" id="guest_count" name="guest_count" class="form-control" min="1" max="{{ $roomType->capacity }}" required>
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
                    .star {
                        font-size: 2rem;
                        cursor: pointer;
                        color: #ddd;
                        /* Màu mặc định của sao (xám nhạt) */
                        transition: color 0.2s ease-in-out;
                        /* Thêm hiệu ứng mượt mà khi thay đổi màu */
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
                        <h5 class="card-title">nnvnvn</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Rating: 3</h6>
                        <p class="card-text">mdfkfkfkfkmfdkm</p>
                        <p class="card-text"><small class="text-muted">Posted on 12/1/1222</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection