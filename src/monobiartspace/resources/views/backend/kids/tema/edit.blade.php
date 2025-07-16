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
    <x-slot:title>Edit Tema</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-tema.update', ['kidsTema' => $kidsTema->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label for="kid_id" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="kid_id" id="kid_id"
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
                                <label for="nama" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" id="nama"
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
                                <label for="deskripsi" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi" id="deskripsi" rows="10"
                                        class="form-control h-auto @error('harga')
                                        is-invalid
                                    @enderror"
                                        required>{{ $errors->any() ? old('deskripsi') : $kidsTema->deskripsi }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="waktu" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Bulan</label>
                                <div class="col-sm-9">
                                    <input type="month" name="waktu" id="waktu"
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
                            <div class="mb-3">
                                <label for="oldImages" class="col-sm-3 col-form-label" style="direction: ltr;">Foto
                                    Lama</label>
                                <div class="col-sm-12">
                                    <div id="oldImages" class="d-flex gap-2 flex-wrap">
                                        @foreach ($kidsTema->images as $image)
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
                            <div class="mb-3 row">
                                <label for="isactive" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Aktif</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="is_active" type="checkbox" role="switch"
                                            id="isactive" {{ $kidsTema->is_active ? 'checked' : '' }}>
                                    </div>
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
