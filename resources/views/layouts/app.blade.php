<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

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

</head>

<body>
    @include('partials.header-user')

    <!-- Page Heading -->


    <!-- Page Content -->
    <main>
        <div class="container">
            {{ $slot }}
        </div>
    </main>
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
</body>

</html>