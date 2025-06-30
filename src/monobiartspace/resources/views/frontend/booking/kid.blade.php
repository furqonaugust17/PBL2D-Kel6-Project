@section('script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('landing-page/assets/js/custom.js') }}"></script>
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
                        kelas,
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
                            <table class="text-start w-100">
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Nama Lengkap Anak</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="nama-lengkap">${nama_lengkap}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Nama Panggilan Anak</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="nama-panggilan">${nama_panggilan}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Tanggal Lahir</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="tgl-lahir">${tanggal_lahir}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Umur Saat ini</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="umur">${usia_saat_ini}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Kelas</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="kelas">${$(`select[name="kelas_id"] option[value="${kelas}"]`)
                            .html()}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Kategori</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="kategori">${$(
                                `select[name="kategori_id"] option[value="${kategori}"]`)
                            .html()}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Jadwal</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="jadwal">${$(
                                `select[name="jadwal_id"] option[value="${jadwal}"]`)
                            .html()}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Tema yang Dipilih</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="tema">
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
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Harga</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="harga-responsive d-block d-md-table-cell d-lg-table-cell">${currency(data.harga)}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Diskon</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="harga-responsive d-block d-md-table-cell d-lg-table-cell">${currency(data.diskon)}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">Total Pembayaran</td>
                            <td class="responsive-text d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="harga-responsive d-block d-md-table-cell d-lg-table-cell">${currency(data.total_bayar)}</td>
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
                        if (result.data) {
                            $('.tema-data').append(`<span>${result.data.nama}</span>`);
                            $('.tema-data').append(`<ul></ul>`);
                            $.each(result.data.detail_tema, function(key, val) {
                                $('.tema-data ul').append(`
                            <li>
                                <input type="checkbox" id="${key}" name="tema" value="${val.id}" ${(key + 1) < mingguKeBerapa() ? 'disabled' : ''}   />
                                <label for="${key}">${val.nama} (Week ${val.week})
                                    </li>
                                    `);
                            })
                        } else {
                            $('.tema-data').append(`<h2>Saat ini belum ada tema.</h2>`);
                        }
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
                            <td class="d-lg-table-cell d-block">Nama Lengkap Anak</td>
                            <td class="d-lg-table-cell d-block">
                                <input class="form-control" type="text" name="nama-lengkap" id="nama-lengkap"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block">Nama Panggilan Anak</td>
                            <td class="d-lg-table-cell d-block">
                                <input class="form-control" type="text" name="nama-panggilan" id="nama-panggilan"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block">Usia Anak Saat Ini</td>
                            <td class="d-lg-table-cell d-block">
                                <input class="form-control" type="number" name="usia-saat-ini" id="usia-saat-ini"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block">Tanggal Lahir anak</td>
                            <td class="d-lg-table-cell d-block">
                                <input class="form-control" type="date" name="tgl-lahir" id="tgl-lahir"
                                    onclick="this.showPicker()" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block">Pilih Kelas</td>
                            <td class="d-lg-table-cell d-block">
                                <select class="form-control" name="kelas_id" id="kelas" required>
                                    <option value="" selected disabled>== Pilih Kelas ==</option>
                                    @foreach ($kids as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block">Pilih Kategori</td>
                            <td class="d-lg-table-cell d-block">
                                <select class="form-control" name="kategori_id" id="kategori" required>
                                    <option value="" selected disabled>Silahkan Pilih Kelas Terlebih Dahulu
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block">Pilih Jadwal</td>
                            <td class="d-lg-table-cell d-block">
                                <select class="form-control" name="jadwal_id" id="jadwal" required>
                                    <option value="" selected disabled>Silahkan Pilih Kelas Terlebih Dahulu
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-lg-table-cell d-block" style="vertical-align: top;">Tema</td>
                            <td class="d-lg-table-cell d-block">
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
