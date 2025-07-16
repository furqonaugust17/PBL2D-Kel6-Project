<x-guest-layout>
    <x-slot:title>Login</x-slot:title>
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
                                    <h4 class="text-center mb-4">Yuk, login dulu!</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <x-input-label for="email" class="mb-1">
                                                <strong>Email</strong>
                                            </x-input-label>
                                            <x-text-input id="email" class="form-control" type="email"
                                                name="email" :value="old('email')" required autofocus
                                                autocomplete="username" />
                                        </div>
                                        <div class="form-group">
                                            <x-input-label for="password" class="mb-1">
                                                <strong>Password</strong>
                                            </x-input-label>
                                            <x-text-input id="password" class="form-control" type="password"
                                                name="password" required autocomplete="current-password" />
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="rember"
                                                        name="rember">
                                                    <x-input-label class="form-check-label" for="rember">Ingat
                                                        Saya</x-input-label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ route('password.request') }}">Lupa Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>belum punya akun? <a class="text-primary"
                                                href="{{ route('register') }}">registrasi</a></p>
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
