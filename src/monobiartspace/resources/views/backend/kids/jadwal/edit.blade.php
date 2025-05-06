<x-app-layout>
    <x-slot:title>Edit Jadwal</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-jadwal.update', ['jadwalKid' => $jadwalKid->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="kid_id" id=""
                                        class="form-control  @error('kid_id')
                                        is-invalid
                                    @enderror">
                                        @foreach ($kids as $kid)
                                            <option value="{{ $kid->id }}"
                                                {{ $jadwalKid->kid_id == $kid->id ? 'selected' : '' }}>
                                                {{ $kid->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kid_id')
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
                                            <option value="{{ $index }}"
                                                {{ $jadwalKid->hari == $index ? 'selected' : '' }}>{{ $day }}
                                            </option>
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
                                        onclick="this.showPicker()"
                                        value="{{ $errors->any() ? old('mulai') : date('H:i', strtotime($jadwalKid->mulai)) }}">
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
                                        onclick="this.showPicker()"
                                        value="{{ $errors->any() ? old('akhir') : date('H:i', strtotime($jadwalKid->akhir)) }}">
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
