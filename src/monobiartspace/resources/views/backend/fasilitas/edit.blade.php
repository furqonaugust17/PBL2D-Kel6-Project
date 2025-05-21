<x-app-layout>
    <x-slot:title>Edit Fasilitas</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Nama Fasilitas</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_fasilitas"
                                        class="form-control @error('nama_fasilitas') is-invalid @enderror"
                                        placeholder="Nama Fasilitas" required
                                        value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}">
                                    @error('nama_fasilitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Ruang</label>
                                <div class="col-sm-9">
                                    <select name="id_ruang" 
                                            class="form-control @error('id_ruang') is-invalid @enderror" 
                                            required>
                                        @foreach($ruangs as $ruang)
                                            <option value="{{ $ruang->id }}" 
                                                {{ old('id_ruang', $fasilitas->id_ruang) == $ruang->id ? 'selected' : '' }}>
                                                {{ $ruang->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_ruang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row justify-content-end">
                                <div class="col-2">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
