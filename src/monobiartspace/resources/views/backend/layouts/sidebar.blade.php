<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="{{ asset('images/Untitled-1.jpg') }}" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> {{ Auth::user()->name }}</h5>
            <p class="email">{{ Auth::user()->email }}</p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a class="ai-icon" href="{{ route('dashboard') }}">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('pendaftaran.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span class="nav-text">Pendaftaran</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('pembayaran.index') }}">
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-text">Pembayaran</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-chalkboard"></i>
                    <span class="nav-text">Monobi Art Space</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('artspace.index') }}">Kelas</a></li>
                    <li><a href="{{ route('kegiatan-artspace.index') }}">Kegiatan</a></li>
                    <li><a href="{{ route('artspace-jadwal.index') }}">Jadwal</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-chalkboard"></i>
                    <span class="nav-text">Monobi Kids</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('kids.index') }}">Kelas</a></li>
                    <li><a href="{{ route('kids-kategori.index') }}">Kategori</a></li>
                    <li><a href="{{ route('kids-jadwal.index') }}">Jadwal</a></li>
                    <li><a href="{{ route('kids-tema.index') }}">Tema</a></li>
                    <li><a href="{{ route('kids-price.index') }}">Harga</a></li>
                </ul>
            </li>
            <li><a href="{{ route('karyawan.index') }}" class="ai-icon">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Manajemen Karyawan</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('customer.index') }}">
                    <i class="fas fa-user"></i>
                    <span class="nav-text">Customer</span>
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
                    <span class="nav-text">Diskon</span>
                </a>
            </li>
        </ul>
    </div>
</div>
