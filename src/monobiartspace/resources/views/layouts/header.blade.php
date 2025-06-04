<header id="header" class="header d-flex align-items-center fixed-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown"><a href="#"><span>Booking</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ route('booking.artspace') }}">Monobi Art Space</a></li>
                        <li><a href="{{ route('booking.kids') }}">Monobi Kids</a></li>
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
                <a class="btn" href="index.html#about">Login</a>
                <a class="btn-getstarted m-0" href="index.html#about">Register</a>
            @endif
        </div>
    </div>
</header>
