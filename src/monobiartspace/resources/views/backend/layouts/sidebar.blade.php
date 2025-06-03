<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="{{ asset('images/Untitled-1.jpg') }}" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> Marquez</h5>
            <p class="email">marquezzzz@mail.com</p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a class="ai-icon" href="{{ route('dashboard') }}">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('ruang.index') }}">
                <i class="fas fa-warehouse"></i>
                <span class="nav-text">Manajemen Ruang</span>
            </a>
            </li>
            <li><a class="ai-icon" href="{{ route('fasilitas.index') }}">
                <i class="fas fa-screwdriver"></i>
                <span class="nav-text">Manajemen Fasilitas</span>
            </a>
            </li>
        </ul>
    </div>
</div>
