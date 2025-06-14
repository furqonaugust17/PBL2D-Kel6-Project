<header id="header" class="header d-flex align-items-center fixed-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="{{ asset('images/monobi_logo.png') }}" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ Request::path() != '/' ? url('/#hero') : '#hero' }}">Home</a></li>
                <li><a href="{{ Request::path() != '/' ? url('/#about') : '#about' }}">About</a></li>
                <li><a href="{{ Request::path() != '/' ? url('/#class') : '#class' }}">Class</a></li>
                <li><a href="{{ Request::path() != '/' ? url('/#services') : '#services' }}">Services</a></li>
                <li><a href="{{ Request::path() != '/' ? url('/#contact') : '#contact' }}">Contact</a></li>
                <li class="dropdown"><a href="#"><span>Booking</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ route('booking.artspace') }}">Monobi Art Space</a></li>
                        <li><a href="{{ route('booking.kids') }}">Monobi Kids</a></li>
                        <li><a href="{{ route('class.index') }}">List Class</a></li>
                        @if (Auth::user())
                            <li>
                                <a href="{{ route('booking') }}">List Booking</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-flex">
            @if (Auth::user())
                <a class="btn btn-getstarted" href="index.html#about">Profile</a>
            @else
                <a class="btn" href="{{ route('login') }}">Login</a>
                <a class="btn-getstarted m-0" href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>
</header>
