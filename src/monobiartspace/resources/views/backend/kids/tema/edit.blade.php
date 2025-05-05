<x-app-layout>
    <x-slot:title>Edit Tema</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-tema.update', ['kidsTema' => $kidsTema->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="kid_id" id=""
                                        class="form-control @error('kid_id')
                                    is-invalid
                                @enderror">
                                        @foreach ($kids as $kid)
                                            <option value="{{ $kid->id }}"
                                                {{ $kidsTema->kid_id == $kid->id ? 'selected' : '' }}>
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
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                        placeholder="Judul Tema" required
                                        value="{{ $errors->any() ? old('nama') : $kidsTema->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Bulan</label>
                                <div class="col-sm-9">
                                    <input type="month" name="waktu" id=""
                                        class="form-control @error('waktu')
                                        is-invalid
                                    @enderror"
                                        value="{{ $errors->any() ? old('waktu') : date('Y-m', strtotime($kidsTema->waktu)) }}"
                                        onclick="this.showPicker()">
                                    @error('waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @foreach ($kidsTema->detailTema as $index => $detail)
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" style="direction: ltr;">Week
                                        {{ $index + 1 }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="week[]" id=""
                                            class="form-control @error('week.' . $index)
                                        is-invalid
                                    @enderror"
                                            value="{{ $errors->any() ? old('week.' . $index) : $detail->nama }}">
                                        @error('week.' . $index)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
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
