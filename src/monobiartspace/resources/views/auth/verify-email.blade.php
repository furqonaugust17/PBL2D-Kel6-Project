<x-guest-layout>
    <x-slot:title>Verifikasi Email</x-slot:title>
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
                                    {{ __('Terima kasih sudah daftar! Sebelum lanjut, yuk verifikasi email kamu lewat link yang sudah kami kirim.') }}
                                </p>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 fw-medium text-sm text-success">
                                        {{ __('Tautan verifikasi baru telah kami kirimkan ke alamat email yang kamu gunakan saat mendaftar.') }}
                                    </div>
                                @endif

                                <div class="mt-4 flex items-center justify-between">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Kirim Ulang
                                                Verifikasi Email</button>
                                        </div>
                                    </form>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit" class="btn btn-link text-muted">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
