<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    @vite('resources/css/bootstrap.min.css')

    </head>
    <body class="bg-light text-dark">
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-5 bg-light dark:bg-dark">
        <div class="w-20 col-sm-6 col-md-4 mt-6 px-4 py-4 bg-white shadow rounded">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
