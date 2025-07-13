<section class="mb-4">
    <header class="mb-3">
        <h2 class=" text-dark">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="small text-muted">
            {{ __('Setelah akun kamu dihapus, semua datanya akan dihapus secara permanen. Sebelum menghapus akun kamu, silakan unduh data atau informasi apa pun yang ingin kamu simpan.') }}
        </p>
    </header>

    <!-- Trigger Modal Button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Hapus Akun') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                            {{ __('Kamu yakin ingin menghapus kamu?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small">
                            {{ __('Setelah akun kamu dihapus, semua datanya akan dihapus secara permanen. Masukkan kata sandi kamu untuk mengonfirmasi bahwa kamu ingin menghapus akun kamu secara permanen.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="{{ __('Password') }}">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Batal') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Hapus Akun') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
