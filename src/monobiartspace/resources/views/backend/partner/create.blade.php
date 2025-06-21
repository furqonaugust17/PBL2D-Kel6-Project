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
    <x-slot:title>Tambah Partner</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Partner</label>
                                    <input type="text" placeholder="Nama Partner"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required>
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
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="contoh: jhondoe@gmail.com"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
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
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control h-auto @error('description') is-invalid @enderror" name="description" rows="4"
                                        required>{{ old('description') }}</textarea>
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
