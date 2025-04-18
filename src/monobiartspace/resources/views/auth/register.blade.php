@section('css')
    <link href="{{ asset('plugins/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    {{-- <script src="{{ asset('plugins/vendor/jquery-steps/build/jquery.steps.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/vendor/jquery-validation/jquery.validate.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
@endsection
<x-guest-layout>
    <x-slot:title>Register</x-slot:title>
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="images/logo-full-black.png" alt="">
                                    </div>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <x-input-label class="mb-1" for="username">
                                                <strong>Username</strong>
                                            </x-input-label>
                                            <x-text-input id="name" class="form-control" type="text"
                                                name="username" :value="old('username')" required autofocus
                                                autocomplete="username" />
                                        </div>
                                        <div class="form-group">
                                            <x-input-label class="mb-1" for="email">
                                                <strong>Email</strong>
                                            </x-input-label>
                                            <x-text-input id="email" class="form-control" type="email"
                                                name="email" :value="old('email')" required autocomplete="email" />
                                        </div>
                                        <div class="form-group">
                                            <x-input-label for="password" class="mb-1">
                                                <strong>Password</strong>
                                            </x-input-label>

                                            <x-text-input id="password" class="form-control" type="password"
                                                name="password" required autocomplete="new-password" />
                                        </div>
                                        <div class="form-group">
                                            <x-input-label for="konfirmasi-password" class="mb-1">
                                                <strong>Konfirmasi Password</strong>
                                            </x-input-label>

                                            <x-text-input id="konfirmasi-password" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div> --}}
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
                                        <p>Already have an account? <a class="text-primary"
                                                href="{{ route('login') }}">Sign
                                                in</a></p>
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
