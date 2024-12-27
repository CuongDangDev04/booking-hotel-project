<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hotelier - Hotel HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- Các thư viện CSS cần thiết, như animate và owl carousel -->
    <link href=" {{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <!-- Thêm CSS của Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Tệp Bootstrap CSS -->
    @vite('resources/css/bootstrap.min.css')

    <!-- Tệp CSS của template hoặc tùy chỉnh của bạn -->
    @vite('resources/css/style.css')

    <!-- Thêm CSS SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.21/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
    <!-- Thêm JS SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.21/dist/sweetalert2.all.min.js"></script>


    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
    <!-- Spinner End -->


    @if(session('error'))
    <script>
        Swal.fire({
            title: 'Lỗi!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
    @endif


    @include('partials.header-user')

    @yield('content')


    @include('partials.footer-user')




    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Libraries Javascript -->
    <script src=" {{ asset('lib/wow/wow.min.js') }}"></script>
    <script src=" {{ asset('lib/easing/easing.min.js') }}"></script>
    <script src=" {{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src=" {{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src=" {{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src=" {{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src=" {{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src=" {{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>


    @vite('resources/js/main.js')

    <!-- Template Javascript -->
</body>

</html>