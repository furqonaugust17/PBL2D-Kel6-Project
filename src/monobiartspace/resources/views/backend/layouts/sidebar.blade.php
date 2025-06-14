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
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-chalkboard"></i>
                    <span class="nav-text">Monobi Art Space</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('artspace.index') }}">Kelas</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-chalkboard"></i>
                    <span class="nav-text">Monobi Kids</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('kids.index') }}">Kelas</a></li>
                </ul>
            </li>
            <li><a href="{{ route('karyawan.index') }}" class="ai-icon">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Manajemen Karyawan</span>
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
            <li><a class="ai-icon" href="{{ route('diskon.index') }}">
                    <i class="fas fa-percentage"></i>
                    <span class="nav-text">diskon</span>
                </a>
            </li>
        </ul>
    </div>
</div>
