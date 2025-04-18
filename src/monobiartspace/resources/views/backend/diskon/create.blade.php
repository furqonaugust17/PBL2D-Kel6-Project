<x-app-layout>
    <x-slot:title>Tambah Karyawan</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('diskon.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Nama diskon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                        placeholder="Nama diskon" required value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">berapa diskon</label>
                                <div class="col-sm-9">
                                    <input type="number" name="diskon"
                                        class="form-control @error('diskon')
                                        is-invalid
                                    @enderror"
                                        placeholder="berapa diskon" required value="{{ old('diskon') }}">
                                    @error('diskon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">code diskon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="code"
                                        class="form-control @error('code')
                                        is-invalid
                                    @enderror"
                                        placeholder="code diskon" required value="{{ old('code') }}">
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">waktu expired</label>
                                <div class="col-sm-9">
                                    <input type="date" name="expired_date"
                                        class="form-control @error('expired_date')
                                        is-invalid
                                    @enderror"
                                        placeholder="waktu expired" required value="{{ old('expired_date') }}">
                                    @error('expired_date')
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
