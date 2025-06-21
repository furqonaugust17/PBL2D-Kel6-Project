@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#gambar').on('change', function() {
                const file = this.files[0];
                const preview = $('#preview');
                preview.empty();
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.append(
                            `<img src="${e.target.result}" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">`
                        );
                    }
                    reader.readAsDataURL(file);
                }
            });
        })
    </script>
@endsection
<x-app-layout>
    <x-slot:title>Tambah Galeri</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('galeri.update', ['galeri' => $galeri->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image"
                                        id="gambar"
                                        class="form-control @error('image')
                                        is-invalid
                                    @enderror"
                                        placeholder="Gambar" required value="{{ old('image') }}">
                                    <div id="preview" class="mt-2"></div>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Gambar Lama</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('storage/' . $galeri->image) }}" class="img-thumbnail"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" style="direction: ltr;">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi" id=""
                                        class="form-control h-auto @error('deskripsi')
                                        is-invalid
                                    @enderror"
                                        cols="30" rows="10">{{ $errors->any() ? old('deskripsi') : $galeri->deskripsi }}</textarea>
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
