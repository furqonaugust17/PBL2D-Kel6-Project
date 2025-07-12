<section>
    <header>
        <h2 class="text-dark">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="small text-muted">
            {{ __('Perbarui informasi profil kamu disini ya sob.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="nama" class="mb-1" :value="__('Nama')" />
            <input id="nama" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $user->customer->nama_lengkap) }}" required autofocus autocomplete="nama" />
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <x-input-label for="notelp" class="mb-1" :value="__('Jenis Kelamin')" />
            <select class="default-select form-control wide" name="jk">
                <option value="l" {{ $user->customer->jk == 'l' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="p" {{ $user->customer->jk == 'p' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="notelp" class="mb-1" :value="__('Nomor Telepon')" />
            <input id="notelp" name="notelp" type="text"
                class="form-control @error('notelp') is-invalid @enderror"
                value="{{ old('notelp', $user->customer->notelp) }}" required autofocus autocomplete="notelp" />
            @error('notelp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <x-input-label for="alamat" class="mb-1" :value="__('Alamat')" />
            <textarea name="alamat" id="alamat" cols="30" rows="10"
                class="form-control h-auto @error('alamat') is-invalid @enderror" required autofocus autocomplete="alamat">{{ old('alamat', $user->customer->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <x-input-label for="username" class="mb-1" :value="__('Userame')" />
            <input id="username" name="username" type="text"
                class="form-control @error('username') is-invalid @enderror" value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="username" />
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <x-input-label for="email" class="mb-1" :value="__('Email')" />
            <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                required autocomplete="email" />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="small text-muted">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link p-0 align-baseline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small mt-1">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4 mt-2">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>

            @if (session('status') === 'profile-updated')
                <p class="small text-muted mb-0">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
