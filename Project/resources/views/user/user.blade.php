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
    @vite('resources/lib/animate/animate.min.css')
    @vite('resources/lib/animate/animate.min.css')
    @vite('resources/lib/owlcarousel/assets/owl.carousel.min.css')
    @vite(['resources/css/animate.min.css', 'resources/css/owl.carousel.min.css', 'resources/css/tempusdominus-bootstrap-4.min.css'])

    <!-- Customized Bootstrap Stylesheet -->
    @vite('resources/css/bootstrap.min.css')

    <!-- Template Stylesheet -->
    @vite('resources/css/style.css')

</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
    <!-- Spinner End -->




    @include('partials.header-user')

    @yield('content')


    @include('partials.footer-user')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Libraries Javascript -->
    @vite(['resources/js/lib/wow.min.js', 'resources/js/lib/easing.min.js', 'resources/js/lib/waypoints.min.js', 'resources/js/lib/counterup.min.js', 'resources/js/lib/owl.carousel.min.js', 'resources/js/lib/moment.min.js', 'resources/js/lib/moment-timezone.min.js', 'resources/js/lib/tempusdominus-bootstrap-4.min.js'])

    <!-- Template Javascript -->
    @vite('resources/js/main.js')
</body>

</html>