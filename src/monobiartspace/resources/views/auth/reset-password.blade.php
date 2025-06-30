<x-guest-layout>
    <x-slot:title>Reset Password</x-slot:title>
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
                                    {{ __('Yuk, atur ulang password kamu di sini. Biar bisa login lagi tanpa drama!') }}
                                </p>
                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <x-input-label for="email" class="mb-1">
                                            <strong>Email</strong>
                                        </x-input-label>
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <x-input-label for="password" class="mb-1">
                                            <strong>Password</strong>
                                        </x-input-label>
                                        <x-text-input id="password" class="form-control" type="password"
                                            name="password" required autocomplete="new-password" />
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <x-input-label for="password" class="mb-1">
                                            <strong>Konfirmasi Password</strong>
                                        </x-input-label>

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
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
