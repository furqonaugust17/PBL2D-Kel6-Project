<x-guest-layout>
    <x-slot:title>Konfirmasi Password</x-slot:title>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('images/monobi_logo.png') }}" width="50%" alt="">
                                </div>
                                <p class="text-center text-body-secondary mb-4">
                                    {{ __('Buat keamanan, konfirmasi dulu password kamu ya sebelum lanjut.') }}
                                </p>
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <!-- Password -->
                                    <div class="form-group">
                                        <x-input-label for="password" class="mb-1">
                                            <strong>Password</strong>
                                        </x-input-label>

                                        <x-text-input id="password" class="form-control" type="password"
                                            name="password" required autocomplete="current-password" />

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
