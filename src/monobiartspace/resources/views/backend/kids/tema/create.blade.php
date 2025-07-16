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
    <x-slot:title>Tambah Tema</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('kids-tema.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="deskripsi" class="col-sm-3 col-form-label"
                                    style="direction: ltr;">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi" id="deskripsi" rows="10"
                                        class="form-control h-auto @error('harga')
                                        is-invalid
                                    @enderror"
                                        required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
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
                            <div class="mb-3 row">
                                <label for="foto" class="col-sm-3 col-form-label" style="direction: ltr;">Foto (max
                                    5)</label>
                                <div class="col-sm-9">
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="foto[]"
                                        id="foto"
                                        class="form-control @error('foto')
                                        is-invalid
                                    @enderror"
                                        required multiple>
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
