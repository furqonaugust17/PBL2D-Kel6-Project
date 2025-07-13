<section class="py-5">
    <header>
        <h2 class="text-dark">
            {{ __('Perbarui Password') }}
        </h2>

        <p class="small text-muted">
            {{ __('Pastikan akun kamu menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
            <br>
            Password minimal 8 karakter dan wajib
            mengandung huruf besar, huruf
            kecil, angka, dan simbol (misalnya: <code>@</code>, <code>$</code>,
            <code>!</code>).
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Password Sekarang')" />
            <input id="update_password_current_password" name="current_password" type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('Password Baru')" />
            <input id="update_password_password" name="password" type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password" />
            @error('password', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Password Konfirmasi')" />
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4 mt-2">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>

            @if (session('status') === 'password-updated')
                <p class="small text-muted mb-0">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
