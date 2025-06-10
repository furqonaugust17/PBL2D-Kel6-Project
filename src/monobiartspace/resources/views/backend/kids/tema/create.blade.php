<x-app-layout>
    <x-slot:title>Tambah Tema</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-tema.store') }}" method="POST">
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
                                                {{ old('kid_id') == $kid->id ? 'selected' : '' }}>{{ $kid->nama }}
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
                                        placeholder="Judul Tema" required value="{{ old('nama') }}">
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
                                        class="form-control  @error('waktu')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('waktu') }}" onclick="this.showPicker()">
                                    @error('waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" style="direction: ltr;">Week
                                        {{ $i }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="week[]" id=""
                                            class="form-control @error('week.' . ($i - 1))
                                        is-invalid
                                    @enderror"
                                            value="{{ old('week.' . ($i - 1)) }}">
                                    </div>
                                    @error('week.' . ($i - 1))
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endfor
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
