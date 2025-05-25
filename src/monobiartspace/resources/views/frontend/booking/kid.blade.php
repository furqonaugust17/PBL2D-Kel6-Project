@section('script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                if ($("input:checkbox[name=tema]:checked").length <= 0) {
                    Swal.fire({
                        title: "Oops",
                        text: "Tema Harus Dipilih Minimal 1",
                        icon: "warning"
                    });
                }
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

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('booking.kids.calculate') }}",
                    type: "POST",
                    data: {
                        tema
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Konfirmasi Pendaftaran",
                            showCancelButton: true,
                            confirmButtonText: "Daftar",
                            denyButtonText: `Kembali`,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            html: `
                            <table class="text-start">
                        <tr>
                            <td>Nama Lengkap Anak</td>
                            <td>:</td>
                            <td id="nama-lengkap">${nama_lengkap}</td>
                        </tr>
                        <tr>
                            <td>Nama Panggilan Anak</td>
                            <td>:</td>
                            <td id="nama-panggilan">${nama_panggilan}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td id="tgl-lahir">${tanggal_lahir}</td>
                        </tr>
                        <tr>
                            <td>Umur Saat ini</td>
                            <td>:</td>
                            <td id="umur">${usia_saat_ini}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td id="kelas">${$(`select[name="kelas_id"] option[value="${kelas}"]`)
                            .html()}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td id="kategori">${$(
                                `select[name="kategori_id"] option[value="${kategori}"]`)
                            .html()}</td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>:</td>
                            <td id="jadwal">${$(
                                `select[name="jadwal_id"] option[value="${jadwal}"]`)
                            .html()}</td>
                        </tr>
                        <tr>
                            <td>Tema yang Dipilih</td>
                            <td>:</td>
                            <td id="tema">
                                <ul class="m-0" style="list-style-type: '- '; padding-left: 1.2em;">${ data.tema.map(value => `
                                                                                <li>
                                                                                    <div>
                                                                                        <input type="hidden" name="tema[]" value="${value.id}" />
                                                                                        <span>${value.nama}</span>
                                                                                    </div>
                                                                                </li>
                                                                                `).join('')}
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>:</td>
                            <td><b>${data.harga}</b></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td><b>${data.diskon}</b></td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>:</td>
                            <td><b>${data.total_bayar}</b></td>
                        </tr>
                    </table>
                            `,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('booking.kids.store') }}",
                                    type: "POST",
                                    data: {
                                        nama_lengkap,
                                        nama_panggilan,
                                        usia_saat_ini,
                                        tanggal_lahir,
                                        kelas,
                                        kategori,
                                        jadwal,
                                        tema
                                    },
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Memproses...',
                                            text: 'Mohon tunggu sebentar',
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal
                                                    .showLoading();
                                            }
                                        });
                                    },
                                    success: function(data) {
                                        window.snap.pay(
                                            `${data.snapToken}`);
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: xhr.responseJSON
                                                .message,
                                        });
                                    },
                                    complete: function() {
                                        Swal.close();
                                    }
                                })
                            }
                        });
                    },
                })
            })

            $('select[name="kelas_id"]').on('change', function() {
                let uriKategori = "{{ route('kategori.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());

                let uriTema = "{{ route('tema.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());
                $.ajax({
                    url: uriKategori,
                    type: "GET",
                    success: function(result) {
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
                        $('.tema-data').empty();
                        $('.tema-data').append(`<span>${result[0].nama}</span>`);
                        $('.tema-data').append(`<ul></ul>`);
                        $.each(result[0].detail_tema, function(key, val) {
                            $('.tema-data ul').append(`
                            <li>
                                <input type="checkbox" id="${key}" name="tema" value="${val.id}" } ${(key + 1) < mingguKeBerapa() ? 'disabled' : '' />
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
                <input type="text" name="nama-lengkap" required>
            </div>
            <div class="">
                <label for="">Nama Panggilan Anak</label>
                <input type="text" name="nama-panggilan" required>
            </div>
            <div class="">
                <label for="">Usia Anak Saat Ini</label>
                <input type="number" name="usia-saat-ini" required>
            </div>
            <div class="">
                <label for="">Tanggal Lahir anak</label>
                <input type="date" name="tgl-lahir" id="" required>
            </div>
            <div class="">
                <label for="">Pilih Kelas</label>
                <select name="kelas_id" id="" required>
                    <option value="" selected disabled>== Pilih Kelas ==</option>
                    @foreach ($kids as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label for="">Pilih Kategori</label>
                <select name="kategori_id" id="" required>
                    <option value="" selected disabled>== Pilih Kategori ==</option>
                </select>
            </div>
            <div class="">
                <label for="">Pilih Jadwal</label>
                <select name="jadwal_id" id="" required>
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
