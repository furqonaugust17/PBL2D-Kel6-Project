<x-app-layout>
    <x-slot:title>Tambah Harga Monobi Kids</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-price.update', ['kidsPrice' => $kidsPrice->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="kid_id" id="" class="form-control">
                                        @foreach ($kids as $kid)
                                            <option value="{{ $kid->id }}"
                                                {{ $kidsPrice->kid_id == $kid->id ? 'selected' : '' }}>
                                                {{ $kid->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Harga</label>
                                <div class="col-sm-9">
                                    <input type="text" name="harga"
                                        class="form-control @error('harga')
                                        is-invalid
                                    @enderror"
                                        placeholder="Harga Pertemuan" required
                                        value="{{ $errors->any() ? old('harga') : $kidsPrice->harga }}">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Jumlah Pertemuan</label>
                                <div class="col-sm-9">
                                    <input type="number" name="jumlah_pertemuan"
                                        class="form-control @error('jumlah_pertemuan')
                                        is-invalid
                                    @enderror"
                                        placeholder="Jumlah Pertemuan" required
                                        value="{{ $errors->any() ? old('jumlah_pertemuan') : $kidsPrice->jumlah_pertemuan }}">
                                    @error('jumlah_pertemuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi" id="" cols="30" rows="10"
                                        class="form-control h-auto @error('deskripsi')
                                        is-invalid
                                    @enderror">{{ $errors->any() ? old('deskripsi') : $kidsPrice->deskripsi }}</textarea>
                                    @error('deskripsi')
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
