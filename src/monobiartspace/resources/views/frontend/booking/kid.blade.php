@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                let tema = [];
                $("input:checkbox[name=tema]:checked").each(function() {
                    tema.push($(this).val());
                });
                console.log(tema);

            })

            $('select[name="kelas_id"]').on('change', function() {
                console.log($(this).val());
                let uriKategori = "{{ route('kategori.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());

                let uriTema = "{{ route('tema.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());
                $.ajax({
                    url: uriKategori,
                    type: "GET",
                    success: function(result) {
                        console.log(result);
                        $('select[name="kategori_id"]').empty();
                        if (result.length == 0) {
                            $('select[name="kategori_id"]').append(`
                                <option value="" selected disabled>= kategori belum tersedia =</option>
                                `);
                        } else {
                            $.each(result, function(key, val) {
                                $('select[name="kategori_id"]').append(`
                                <option value="${val.id}">${val.nama}</option>
                                `);
                            })
                        }
                    }
                });
                $.ajax({
                    url: uriTema,
                    type: "GET",
                    success: function(result) {
                        console.log(result);
                        $('.tema-data').empty();
                        $('.tema-data').append(`<span>${result[0].nama}</span>`);
                        $('.tema-data').append(`<ul></ul>`);
                        $.each(result[0].detail_tema, function(key, val) {
                            $('.tema-data ul').append(`
                            <li>
                                <input type="checkbox" id="${key}" name="tema" value="${val.id}" />
                                <label for="${key}">${val.nama} (Week ${val.week})</label>
                            </li>
                            `);
                        })
                    }
                });
            });
        });
    </script>
@endsection
<x-app>
    <section class="mt-4">
        <form action="" id="form">
            <div class="">
                <label for="">Nama Lengkap Anak</label>
                <input type="text" name="nama-lengkap">
            </div>
            <div class="">
                <label for="">Nama Panggilan Anak</label>
                <input type="text" name="nama-panggilan">
            </div>
            <div class="">
                <label for="">Usia Anak Saat Ini</label>
                <input type="number" name="usia-saat-ini">
            </div>
            <div class="">
                <label for="">Tanggal Lahir anak</label>
                <input type="date" name="tgl-lahir" id="">
            </div>
            <div class="">
                <label for="">Pilih Kelas</label>
                <select name="kelas_id" id="">
                    <option value="" selected disabled>== Pilih Kelas ==</option>
                    @foreach ($kids as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label for="">Pilih Kategori</label>
                <select name="kategori_id" id="">
                    <option value="" selected disabled>== Pilih Kategori ==</option>
                </select>
            </div>
            <div class="">
                <label for="">Tema</label>
                <div class="tema-data">
                </div>
            </div>
            <button type="submit">Daftar</button>
        </form>
    </section>
</x-app>
