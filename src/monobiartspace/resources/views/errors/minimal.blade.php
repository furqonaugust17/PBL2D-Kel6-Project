<!DOCTYPE html>
<html lang="en" class="h-100">

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
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/monobi_icon.png') }}">
    <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text font-weight-bold">@yield('code')</h1>
                        <h4>@yield('sub-title')</h4>
                        <p>@yield('message')</p>
                        <div>
                            <a class="btn btn-primary"
                                href="{{ !Auth::check() || Auth::user()->hasRole('customer') ? url('/') : route('dashboard') }}">Back
                                to
                                Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
 Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('plugins/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/js/deznav-init.js') }}"></script>
</body>

</html>
