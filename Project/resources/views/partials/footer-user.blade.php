<!-- Footer Start -->
@php
$isDetailRoomPage = Route::currentRouteName() === 'room.show';
@endphp
<div class="container-fluid bg-dark text-light footer wow fadeIn {{ $isDetailRoomPage ? 'mt-0 pt-0' : '' }}" data-wow-delay="0.1s">
    <div class="container pb-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-4">
                <div class="bg-primary rounded p-4 d-flex justify-content-center">
                    <a href="index.html" class="d-flex">
                        <h1 class="text-white text-uppercase m-auto">Hotelier</h1>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="section-title text-start text-primary text-uppercase mb-4">Liên Hệ</h6>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>331 QL1A, An Phú Đông, Quận 12, Hồ Chí Minh, Việt Nam</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>cuongdang.270920@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="row gy-5 g-4">
                    <div class="col-md-6">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Công Ty</h6>
                        <a class="btn btn-link" href="">Giới Thiệu</a>
                        <a class="btn btn-link" href="">Liên Hệ</a>
                        <a class="btn btn-link" href="">Chính Sách Bảo Mật</a>
                        <a class="btn btn-link" href="">Điều Khoản Và Điều Kiện</a>
                        <a class="btn btn-link" href="">Hỗ Trợ</a>
                    </div>
                    <div class="col-md-6">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Dịch Vụ</h6>
                        <a class="btn btn-link" href="">Ăn Uống</a>
                        <a class="btn btn-link" href="">Chăm Sóc Sức Khỏe</a>
                        <a class="btn btn-link" href="">Thể Thao Và Trò Chơi</a>
                        <a class="btn btn-link" href="">Sự Kiện Và Buổi Tiệc</a>
                        <a class="btn btn-link" href="">GYM & Yoga</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="">Trang Chủ</a>
                        <a href="">Cookies</a>
                        <a href="">Trợ Giúp</a>
                        <a href="">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->