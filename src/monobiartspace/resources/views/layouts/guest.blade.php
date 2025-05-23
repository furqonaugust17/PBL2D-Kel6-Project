<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="MonobiArtSpace" />
    <meta property="og:title" content="MonobiArtSpace" />
    <meta property="og:description" content="MonobiArtSpace" />
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/favicon.png') }}">
    @yield('css')
    <link href="{{ asset('plugins/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    {{ $slot }}

    <script src="{{ asset('plugins/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/js/deznav-init.js') }}"></script>
    @yield('script')

</body>

</html>
