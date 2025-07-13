@section('css')
    <link href="{{ asset('plugins/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{ asset('plugins/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
@endsection
<x-guest-layout>
    <x-slot:title>Register</x-slot:title>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('images/monobi_logo.png') }}" width="50%" alt="">
                                    </div>
                                    <h4 class="text-center mb-1">Ayo sobat, daftar sekarang!</h4>
                                    <div class="alert alert-info m-0">
                                        <strong>📋 Perhatikan sebelum mendaftar:</strong>
                                        <ul class="mb-0 mt-2 ps-4">
                                            <li style="list-style: disc;">Nomor telepon harus dimulai dengan
                                                <code>+62</code> dan berisi 9-15
                                                digit angka.
                                            </li>
                                            <li style="list-style: disc;">Email yang digunakan harus valid dan belum
                                                pernah terdaftar.</li>
                                            <li style="list-style: disc;">Password minimal 8 karakter dan wajib
                                                mengandung huruf besar, huruf
                                                kecil, angka, dan simbol (misalnya: <code>@</code>, <code>$</code>,
                                                <code>!</code>).
                                            </li>
                                        </ul>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div id="smartwizard" class="form-wizard order-create">
                                            <ul class="nav nav-wizard">
                                                <li><a class="nav-link" href="#data_diri">
                                                        <span>1</span>
                                                    </a></li>
                                                <li><a class="nav-link" href="#akun">
                                                        <span>2</span>
                                                    </a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="data_diri" class="tab-pane" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label">Nama Lengkap</label>
                                                                <input value="{{ old('nama_lengkap') }}" type="text"
                                                                    name="nama_lengkap"
                                                                    class="form-control @error('nama_lengkap')
                                                                        is-invalid
                                                                    @enderror"
                                                                    placeholder="masukan nama anda" required>
                                                                @error('nama_lengkap')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label">Jenis Kelamin</label>
                                                                <select name="jk" id=""
                                                                    class="form-control">
                                                                    <option value="l">Laki-Laki</option>
                                                                    <option value="p">Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label">Nomor Telepon</label>
                                                                <input value="{{ old('notelp') }}" type="text"
                                                                    name="notelp"
                                                                    class="form-control  @error('notelp')
                                                                        is-invalid
                                                                    @enderror"
                                                                    placeholder="+628########" required>
                                                                @error('notelp')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="form-group">
                                                                <label class="text-label">Alamat</label>
                                                                <input value="{{ old('alamat') }}" type="text"
                                                                    name="alamat"
                                                                    class="form-control  @error('alamat')
                                                                        is-invalid
                                                                    @enderror"
                                                                    placeholder="Jl.####" required>
                                                                @error('alamat')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="akun" class="tab-pane" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label">Username</label>
                                                                <input value="{{ old('username') }}" type="text"
                                                                    name="username"
                                                                    class="form-control  @error('username')
                                                                        is-invalid
                                                                    @enderror"
                                                                    placeholder="johndoe" required>
                                                                @error('username')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label" for="email">Email</label>
                                                                <input value="{{ old('email') }}" type="email"
                                                                    name="email"
                                                                    class="form-control  @error('email')
                                                                        is-invalid
                                                                    @enderror"
                                                                    id="email" placeholder="example@example.com"
                                                                    required>
                                                                @error('email')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label">Password</label>
                                                                <input value="{{ old('password') }}" type="password"
                                                                    name="password"
                                                                    class="form-control  @error('password')
                                                                        is-invalid
                                                                    @enderror"
                                                                    placeholder="" required>
                                                                @error('password')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label class="text-label">Konfirmasi Password</label>
                                                                <input value="{{ old('password_confirmation') }}"
                                                                    type="password" name="password_confirmation"
                                                                    class="form-control  @error('password_confirmation')
                                                                        is-invalid
                                                                    @enderror"
                                                                    required>
                                                                @error('password_confirmation')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>sudah punya akun? <a class="text-primary"
                                                href="{{ route('login') }}">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
