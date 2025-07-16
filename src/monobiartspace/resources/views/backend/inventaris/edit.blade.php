<x-app-layout>
    <x-slot:title>Edit Inventaris</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('inventaris.update', ['inventaris'=>$inventaris->id]) }}" method="POST" novalidate>
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_barang"
                                        class="form-control @error('nama_barang') is-invalid @enderror"
                                        placeholder="Nama Barang" required
                                        value="{{ $errors->any() ? old('nama_barang') : $inventaris->nama_barang }}">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                        <option value="Peralatan"
                                            {{ ($errors->any() ? old('kategori') : $inventaris->kategori) == 'Peralatan' ? 'selected' : '' }}>
                                            Peralatan</option>
                                        <option value="Bahan"
                                            {{ ($errors->any() ? old('kategori') : $inventaris->kategori) == 'Bahan' ? 'selected' : '' }}>
                                            Bahan</option>
                                        <option value="Lainnya"
                                            {{ ($errors->any() ? old('kategori') : $inventaris->kategori) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Jumlah Stok Awal</label>
                                <div class="col-sm-9">
                                    <input type="number" name="jumlah_stok_awal"
                                        class="form-control @error('jumlah_stok_awal') is-invalid @enderror"
                                        placeholder="Jumlah Stok Awal" required
                                        value="{{ $errors->any() ? old('jumlah_stok_awal') : $inventaris->jumlah_stok_awal }}">
                                    @error('jumlah_stok_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                        rows="3" placeholder="Keterangan">{{ $errors->any() ? old('keterangan') : $inventaris->keterangan }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
