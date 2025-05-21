@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                let nama_lengkap = $('input[name="nama-lengkap"]').val();
                let nama_panggilan = $('input[name="nama-panggilan"]').val();
                let usia_saat_ini = $('input[name="usia-saat-ini"]').val();
                let tanggal_lahir = $('input[name="tgl-lahir"]').val();
                let kelas = $('select[name="kelas_id"]').val();
                let kategori = $('select[name="kategori_id"]').val();
                let jadwal = $('select[name="jadwal_id"]').val();
                let tema = [];
                $("input:checkbox[name=tema]:checked").each(function() {
                    tema.push($(this).val());
                });
                console.log({
                    nama_lengkap,
                    nama_panggilan,
                    usia_saat_ini,
                    tanggal_lahir,
                    kelas,
                    kategori,
                    jadwal,
                    tema
                });
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
                            $('select[name="kategori_id"]').append(`
                                <option value="" selected disabled>== Pilih Kategori ==</option>
                                `);
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
                                <input type="checkbox" id="${key}" name="tema" value="${val.id}" ${(key + 1) < mingguKeBerapa() ? 'disabled' : ''} />
                                <label for="${key}">${val.nama} (Week ${val.week})</label>
                            </li>
                            `);
                        })
                    }
                });
            });

            $('select[name="kategori_id"]').on('change', function() {
                let uriJadwal = "{{ route('jadwal.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());
                $.ajax({
                    url: uriJadwal,
                    type: "GET",
                    success: function(result) {
                        console.log(result);
                        $('select[name="jadwal_id"]').empty();
                        if (result.length == 0) {
                            $('select[name="jadwal_id"]').append(`
                                <option value="" selected disabled>= jadwal belum tersedia =</option>
                                `);
                        } else {
                            $('select[name="jadwal_id"]').append(`
                                <option value="" selected disabled>== Pilih jadwal ==</option>
                                `);
                            $.each(result, function(key, val) {
                                $('select[name="jadwal_id"]').append(`
                                <option value="${val.id}">${val.hari} (${val.mulai.substring(0,5)} - ${val.akhir.substring(0,5)})</option>
                                `);
                            })
                        }
                    }
                });
            })

            function mingguKeBerapa() {
                const date = new Date();
                const tanggal = date.getDate();
                const hariPertama = new Date(date.getFullYear(), date.getMonth(), 1)
                    .getDay();
                return Math.ceil((tanggal + hariPertama) / 7);
            }

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
                <label for="">Pilih Jadwal</label>
                <select name="jadwal_id" id="">
                    <option value="" selected disabled>== Pilih Jadwal ==</option>
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
