<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/monobi_icon.png') }}" />
    @yield('css')
    <link href="{{ asset('plugins/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/vendor/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('images/monobi_icon.png') }}" width="50" height="50"
                    alt="">
                <h3 class="brand-title mb-0">Monobi</h3>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        @include('backend.layouts.header')
        @include('backend.layouts.sidebar')

        <div class="content-body">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>

        <div class="footer">
            <div class="copyright">
                <p>Copyright © {{ config('app.name') }}</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('plugins/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/js/deznav-init.js') }}"></script>

    @yield('script')
    @if (session('success'))
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.success("{{ session('success') }}", {
                    closeButton: false,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: 300,
                    hideDuration: 1000,
                    timeOut: 500,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                })

            })
        </script>
    @endif


</body>

</html>
