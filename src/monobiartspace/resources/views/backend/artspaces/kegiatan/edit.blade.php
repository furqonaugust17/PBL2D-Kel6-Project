@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="foto[]"]').on('change', function() {
                const maxFiles = 5;
                const files = this.files;
                const $previewContainer = $('#previewContainer');
                const $errorMsg = $('#errorMsg');
                $previewContainer.empty();
                $errorMsg.text('');

                if (files.length > maxFiles) {
                    $errorMsg.text(`Maksimal upload ${maxFiles} gambar.`);
                    $(this).val('');
                    return;
                }

                $.each(files, function(i, file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const $img = $('<img>', {
                            src: e.target.result,
                            class: 'img-thumbnail',
                            css: {
                                width: '120px',
                                height: '120px',
                                objectFit: 'cover',
                                marginRight: '10px',
                                marginBottom: '10px'
                            }
                        });
                        $previewContainer.append($img);
                    };

                    reader.readAsDataURL(file);
                });
            })
        })
    </script>
@endsection
<x-app-layout>
    <x-slot:title>Edit Kegiatan Kelas</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kegiatan-artspace.update', ['kegiatanArtSpace' => $kegiatan->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-3 col-form-label" style="direction: ltr;">Nama
                                    Kegiatan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" id="nama"
                                        class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                        placeholder="Nama Kegiatan" required
                                        value="{{ $errors->any() ? old('nama') : $kegiatan->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="artspace_id" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="artspace_id" id="artspace_id" class="form-control">
                                        @foreach ($kelases as $kelas)
                                            <option value="{{ $kelas->id }}"
                                                {{ $kegiatan->artspace_id == $kelas->id ? 'selected' : '' }}>
                                                {{ $kelas->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsi" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi" id="deskripsi" rows="10"
                                        class="form-control h-auto @error('harga')
                                        is-invalid
                                    @enderror"
                                        required>{{ $errors->any() ? old('deskripsi') : $kegiatan->deskripsi }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Harga</label>
                                <div class="col-sm-9">
                                    <input type="text" name="harga" id="harga"
                                        class="form-control @error('harga')
                                        is-invalid
                                    @enderror"
                                        placeholder="Harga" required
                                        value="{{ $errors->any() ? old('harga') : $kegiatan->harga }}">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Foto Lama</label>
                                <div class="col-sm-9">
                                    <div id="oldImages" class="d-flex gap-2 flex-wrap">
                                        @foreach ($kegiatan->images as $image)
                                            <img src="{{ asset('storage/' . $image->file) }}" alt="Gambar lama"
                                                class="img-thumbnail"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="foto" class="col-sm-3 col-form-label" style="direction: ltr;">Foto (max
                                    5)</label>
                                <div class="col-sm-9">
                                    @php
                                        $hasFotoError = collect($errors->keys())->contains(
                                            fn($key) => Str::startsWith($key, 'foto.'),
                                        );
                                    @endphp
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="foto[]"
                                        id="foto" class="form-control {{ $hasFotoError ? 'is-invalid' : '' }}"
                                        required multiple>
                                    @foreach ($errors->get('foto.*') as $messages)
                                        @foreach ($messages as $message)
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                    <div id="previewContainer" class="d-flex flex-wrap gap-2 mt-3"></div>
                                    <p id="errorMsg" class="text-danger"></p>
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
