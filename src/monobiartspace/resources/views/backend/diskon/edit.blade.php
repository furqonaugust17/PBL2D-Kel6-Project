<x-app-layout>
    <x-slot:title>Edit Diskon</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('diskon.update', ['diskon' => $diskon->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Nama diskon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                        placeholder="Nama Diskon" required
                                        value="{{ $errors->any() ? old('nama') : $diskon->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Persentase Diskon</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="number" name="diskon"
                                            class="form-control @error('diskon')
                                        is-invalid
                                    @enderror"
                                            placeholder="10" required
                                            value="{{ $errors->any() ? old('diskon') : $diskon->diskon }}">
                                        @error('diskon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kode Diskon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="code"
                                        class="form-control @error('code')
                                        is-invalid
                                    @enderror"
                                        placeholder="RAMADHAN2021" required
                                        value="{{ $errors->any() ? old('code') : $diskon->code }}">
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Waktu Expired</label>
                                <div class="col-sm-9">
                                    <input type="date" name="expired_date"
                                        class="form-control @error('expired_date')
                                        is-invalid
                                    @enderror"
                                        placeholder="waktu expired" required
                                        value="{{ $errors->any() ? old('expired_date') : $diskon->expired_date }}"
                                        onclick="this.showPicker()">
                                    @error('expired_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row justify-content-end">
                                <div class="col-lg-2">
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
