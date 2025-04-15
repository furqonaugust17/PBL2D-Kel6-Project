<x-app-layout>
    <x-slot:title>Edit Karyawan</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" novalidate>
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Nama Karyawan" required
                                        value="{{ $errors->any() ? old('nama') : $karyawan->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select class="default-select form-control wide" name="jk">
                                        <option value="l"
                                            {{ ($errors->any() ? (old('jk') == 'l' ? 'selected' : '') : $karyawan->jk == 'l') ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="p"
                                            {{ ($errors->any() ? (old('jk') == 'p' ? 'selected' : '') : $karyawan->jk == 'p') ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat"
                                        required value="{{ $errors->any() ? old('alamat') : $karyawan->alamat }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">No Telp</label>
                                <div class="col-sm-9">
                                    <input type="text" name="notelp"
                                        class="form-control @error('notelp') is-invalid @enderror"
                                        placeholder="Nomor Telepon" required
                                        value="{{ $errors->any() ? old('notelp') : $karyawan->notelp }}">
                                    @error('notelp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Username" required
                                        value="{{ $errors->any() ? old('username') : $karyawan->user->name }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        required value="{{ $errors->any() ? old('email') : $karyawan->user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-end">
                                <div class="col-2">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
