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
    <x-slot:title>Edit Partner</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('partner.update', ['partner' => $partner->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Partner</label>
                                    <input type="text" placeholder="Nama Partner"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $errors->any() ? old('name') : $partner->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="text" placeholder="contoh: +6287712323132"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ $errors->any() ? old('phone') : $partner->phone }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Gambar Partner</label>
                                    <input type="file" id="gambar"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        accept="image/*" required>
                                    <div id="preview" class="mt-2"></div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Gambar Partner Lama</label>
                            </div>
                            <div class="col-md-12">
                                <img src="{{ asset('storage/' . $partner->image) }}" alt=""
                                    class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control h-auto @error('description') is-invalid @enderror" name="description" rows="4"
                                        required>{{ $errors->any() ? old('description') : $partner->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row justify-content-end">
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-sm btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
