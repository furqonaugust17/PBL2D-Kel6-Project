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
                                        Swal.close();

                                        window.snap.pay(
                                            `${data.snapToken}`);
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.close();
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: xhr.responseJSON
                                                .message,
                                        });
                                    },
                                })
                            }
                        });
                    },
                })
            })

            $('select[name="kelas_id"]').on('change', function() {
                showLoader();
                let uriKategori = "{{ route('kategori.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());

                let uriTema = "{{ route('tema.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());
                $.ajax({
                    url: uriKategori,
                    type: "GET",
                    success: function(result) {
                        hideLoader();
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
                        $('select[name="kategori_id"]').val(result[0].id).trigger('change');
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
                                <input type="checkbox" id="${key}" name="tema" value="${val.id}" ${(key + 1) < mingguKeBerapa() ? 'disabled' : ''}   />
                                <label for="${key}">${val.nama} (Week ${val.week})
                            </li>
                            `);
                        })
                    }
                });

            });

            $('select[name="kategori_id"]').on('change', function() {
                showLoader();
                let uriJadwal = "{{ route('jadwal.getdata', ['id' => ':id']) }}"
                    .replace(':id', $(this).val());
                $.ajax({
                    url: uriJadwal,
                    type: "GET",
                    success: function(result) {
                        hideLoader();
                        $('select[name="jadwal_id"]').empty();
                        if (result.length == 0) {
                            $('select[name="jadwal_id"]').append(`
                                <option value="" selected disabled>= jadwal belum tersedia =</option>
                                `);
                        } else {
                            $.each(result, function(key, val) {
                                $('select[name="jadwal_id"]').append(`
                                <option value="${val.id}">${val.hari} (${val.mulai.substring(0,5)} - ${val.akhir.substring(0,5)})</option>
                                `);
                            })
                        }
                    }
                });
            })

            function showLoader() {
                $('.loading-wrapper').show();
                $('#formContent').addClass('blur');
            }

            function hideLoader() {
                $('.loading-wrapper').hide();
                $('#formContent').removeClass('blur');
            }

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
    <div class="page-title light-background">
        <div class="container">
            <h1>Booking Monobi Kids</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <form action="" id="form" class="position-relative">
                <div class="loading-wrapper" style="display: none;">
                    <div
                        class="loading-item z-3 w-100 h-100 position-absolute d-flex justify-content-center align-items-center flex-column">
                        <i class="spinner-border"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <table class="w-100 z-1" id="formContent">
                    <tbody>
                        <tr>
                            <td>Nama Lengkap Anak</td>
                            <td>
                                <input class="form-control" type="text" name="nama-lengkap" id="nama-lengkap"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Panggilan Anak</td>
                            <td>
                                <input class="form-control" type="text" name="nama-panggilan" id="nama-panggilan"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>Usia Anak Saat Ini</td>
                            <td>
                                <input class="form-control" type="number" name="usia-saat-ini" id="usia-saat-ini"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir anak</td>
                            <td>
                                <input class="form-control" type="date" name="tgl-lahir" id="tgl-lahir"
                                    onclick="this.showPicker()" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Kelas</td>
                            <td>
                                <select class="form-control" name="kelas_id" id="kelas" required>
                                    <option value="" selected disabled>== Pilih Kelas ==</option>
                                    @foreach ($kids as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Kategori</td>
                            <td>
                                <select class="form-control" name="kategori_id" id="kategori" required>
                                    <option value="" selected disabled>Silahkan Pilih Kelas Terlebih Dahulu
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Jadwal</td>
                            <td>
                                <select class="form-control" name="jadwal_id" id="jadwal" required>
                                    <option value="" selected disabled>Silahkan Pilih Kelas Terlebih Dahulu
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Tema</td>
                            <td>
                                <div class="tema-data">
                                    <p>Silahkan Pilih Kelas Terlebih Dahulu</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="button-wrapper w-100 d-flex justify-content-end">
                    <button class="btn btn-primary float-right" type="submit">Daftar</button>
                </div>
            </form>
        </div>
    </section>
</x-app>
