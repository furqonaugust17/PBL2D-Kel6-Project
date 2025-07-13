<x-guest-layout>
    <x-slot:title>Lupa Password</x-slot:title>
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
                                    {{ __('Lupa kata sandi kamu? Tenang aja! Masukkan email kamu dan kami akan kirimkan link buat atur ulang kata sandinya.') }}
                                </p>
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <x-input-label for="email" class="mb-1">
                                            <strong>Email</strong>
                                        </x-input-label>
                                        <x-text-input id="email" class="form-control mt-1 w-full" type="email"
                                            name="email" :value="old('email')" required autofocus />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Email Password Reset
                                            Link</button>
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
