<x-app-layout>
    <x-slot:title>Tambah Karyawan</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="basic-form">
                        <form action="{{ route('karyawan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Nama Karyawan" required value="{{ old('nama') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select class="default-select form-control wide" name="jk">
                                        <option value="l">Laki-Laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat"
                                        required value="{{ old('alamat') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">No Telp</label>
                                <div class="col-sm-9">
                                    <input type="text" name="notelp" class="form-control"
                                        placeholder="Nomor Telepon" required value="{{ old('notelp') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        required value="{{ old('username') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        required value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
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
