<x-app-layout>
    <x-slot:title>Edit Kategori</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-kategori.update', ['kidsKategori' => $kidsKategori->id]) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="kid_id" id="" class="form-control">
                                        @foreach ($kids as $kid)
                                            <option value="{{ $kid->id }}"
                                                {{ $kidsKategori->kid_id == $kid->id ? 'selected' : '' }}>
                                                {{ $kid->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Nama Kategori</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                        placeholder="Nama Kategori" required
                                        value="{{ $errors->any() ? old('nama') : $kidsKategori->nama }}">
                                    @error('nama')
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
                                        class="form-control @error('deskripsi')
                                        is-invalid
                                    @enderror">{{ $errors->any() ? old('deskripsi') : $kidsKategori->deskripsi }}</textarea>
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
