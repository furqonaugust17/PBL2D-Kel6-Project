<x-app-layout>
    <x-slot:title>Tambah Jadwal</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-jadwal.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kategori</label>
                                <div class="col-sm-9">
                                    <select name="kategori_id" id=""
                                        class="form-control  @error('kategori_id')
                                        is-invalid
                                    @enderror">
                                        @foreach ($kategories as $kategoris)
                                            <option value="{{ $kategoris->id }}"
                                                {{ old('kategori_id') == $kategoris->id ? 'selected' : '' }}>
                                                {{ $kategoris->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Hari</label>
                                <div class="col-sm-9">
                                    <select name="hari" id=""
                                        class="form-control  @error('hari')
                                        is-invalid
                                    @enderror">
                                        @foreach ($days as $index => $day)
                                            <option value="{{ $index }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                    @error('hari')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Jadwal Mulai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="mulai" id=""
                                        class="form-control @error('mulai')
                                        is-invalid
                                    @enderror"
                                        onclick="this.showPicker()" value="{{ old('mulai') }}">
                                    @error('mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Jadwal Berakhir</label>
                                <div class="col-sm-9">
                                    <input type="time" name="akhir" id=""
                                        class="form-control @error('akhir')
                                        is-invalid
                                    @enderror"
                                        onclick="this.showPicker()" value="{{ old('akhir') }}">
                                    @error('akhir')
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
