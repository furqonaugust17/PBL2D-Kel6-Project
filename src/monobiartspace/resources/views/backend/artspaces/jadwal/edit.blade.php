<x-app-layout>
    <x-slot:title>Edit Jadwal</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('artspace-jadwal.update', ['jadwalArtSpace' => $jadwalArtSpace->id]) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Sesi</label>
                                <div class="col-sm-9">
                                    <input type="text" name="sesi"
                                        class="form-control @error('sesi')
                                        is-invalid
                                    @enderror"
                                        placeholder="Nama Sesi" required
                                        value="{{ $errors->any() ? old('sesi') : $jadwalArtSpace->sesi }}">
                                    @error('sesi')
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
                                        value="{{ $errors->any() ? old('mulai') : date('H:i', strtotime($jadwalArtSpace->mulai)) }}">
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
                                        value="{{ $errors->any() ? old('akhir') : date('H:i', strtotime($jadwalArtSpace->akhir)) }}">
                                    @error('akhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kapasitas</label>
                                <div class="col-sm-9">
                                    <input type="number" name="kapasitas" id=""
                                        class="form-control @error('kapasitas')
                                        is-invalid
                                    @enderror"
                                        value="{{ $errors->any() ? old('kapasitas') : $jadwalArtSpace->kapasitas }}">
                                    @error('kapasitas')
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
