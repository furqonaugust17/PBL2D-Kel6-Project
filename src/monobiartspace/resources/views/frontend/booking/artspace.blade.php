@section('script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('landing-page/assets/js/custom.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                let tanggal = $('input[name="tanggal"]').val();
                let sesi = $('select[name="sesi"]').val();
                let participants = [];
                $('.participant').each(function() {
                    let name = $(this).find('input[name="participants[][name]"]').val();
                    let activity_id = $(this).find('select[name="participants[][activity_id]"]')
                        .val();

                    participants.push({
                        name: name,
                        activity_id: activity_id
                    });
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('booking.artspace.calculate') }}",
                    type: 'POST',
                    data: {
                        tanggal,
                        sesi,
                        participants,
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Konfirmasi Pendaftaran",
                            width: 750,
                            showCancelButton: true,
                            confirmButtonText: "Daftar",
                            denyButtonText: `Kembali`,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            html: `
                            <table class="text-start w-100">
                        <tr>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">Tanggal Booking</td>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="tgl-booking">${tanggal}</td>
                        </tr>
                        <tr>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">Sesi</td>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="sesi">${$(`select[name="sesi"] option[value="${sesi}"]`).html()}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">Kegiatan</td>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="kegiatan">
                                 <ul class="m-0" style="list-style-type: '- '; padding-left: 1.2em;">
                                    ${ participants.map((value, index) => `<li>${value.name} (${data.data.find(element => element.id === `activity_${value.activity_id}`).name} ${currency(data.data.find(element => element.id === `activity_${value.activity_id}`).price)})</li>`).join('')}
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">Total Pembayaran</td>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="harga-responsive d-block d-md-table-cell d-lg-table-cell" id="total_bayar">${currency(data.total_bayar)}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">Diskon</td>
                            <td class="responsive-text fw-normal d-inline d-md-table-cell d-lg-table-cell">:</td>
                            <td class="d-block d-md-table-cell d-lg-table-cell" id="diskon-wrapper">
                                <div class="row">
                                    <div class="col-8 col-lg-8">
                                        <input type="text" name="diskon" class="form-control" />
                                    </div>
                                    <div class="col-4 col-lg-4">
                                        <button class="btn btn-primary w-100" id="cekDiskon" onclick="cekDiskon('${data.total_bayar}')">cek</button>
                                    </div>
                                    <div class="diskon-message">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                            `,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('booking.artspace.store') }}",
                                    type: "POST",
                                    data: {
                                        tanggal,
                                        sesi,
                                        participants,
                                        diskon: $('input[name="diskon"]').val()
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
                        })
                    }
                })
            })
        });


        let counterParticipant = 1;

        function addParticipant() {
            const container = document.getElementById('participants');
            const html = `
        <tr class="participant">
            <td class="d-lg-table-cell d-block">
                <div class="row align-items-end">
                    <label class="col-sm-4 col-form-label">Nama Peserta</label>
                    <div class="col-sm-8 ps-lg-4" style="">
                        <input type="text" class="form-control" name="participants[][name]"
                            required>
                    </div>
                </div>
            </td>
            <td class="d-lg-table-cell d-block">
                <div class="row">
                    <label class="col-sm-4 col-form-label text-lg-end">Kegiatan</label>
                    <div class="col-sm-8">
                        <select name="participants[][activity_id]" class="form-control">
                            @foreach ($kegiatanArtSpace as $kegiatan)
                                <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp
                                    {{ number_format($kegiatan->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </td>
            <td class="align-bottom">
                    <button type="button" class="btn btn-danger w-100" onclick="removeParticipant(this)"><i
                        class="bi bi-trash"></i></button>
            </td>
        </tr>
        
        `;
            container.insertAdjacentHTML('beforeend', html);
            counterParticipant++;
        }

        function removeParticipant(elemet) {
            $(elemet).closest('tr.participant').remove();
        }

        function cekDiskon(harga) {
            const diskon = $(`input[name=diskon]`).val();
            $.ajax({
                url: `{{ route('checkDiskon') }}`,
                type: 'POST',
                data: {
                    diskon
                },
                beforeSend: function() {
                    $('#diskon-wrapper input').attr('disabled', true);
                    $('#diskon-wrapper button').attr('disabled', true);
                    $('.diskon-message').empty()
                },
                success: function(response) {
                    if (response.success) {
                        endTotal = parseInt(harga) - (parseInt(harga) * (response.data.diskon / 100));
                        $('.diskon-message').append(
                            `<span class="text-success fs-6">${response.message}</span`);
                        $('#total_bayar').html(currency(endTotal))
                    } else {
                        $('#diskon-wrapper input').attr('disabled', false);
                        $('#diskon-wrapper button').attr('disabled', false);
                        $('.diskon-message').append(
                            `<span class="text-danger fs-6">${response.message}</span`);
                    }
                },
                error: function(xhr, status, error) {
                    $('#diskon-wrapper input').attr('disabled', false);
                    $('#diskon-wrapper button').attr('disabled', false);
                    $('.diskon-message').append(
                        `<span class="text-danger fs-6">${xhr.responseJSON.message}</span`);
                }
            })
        }
    </script>
@endsection
<x-app>
    <div class="page-title light-background">
        <div class="container">
            <h1>Booking ArtSpace</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <form action="{{ route('booking.artspace.store') }}" method="POST" id="form">
                @csrf
                <table class="w-100">
                    <thead>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <label for="booking-date" class="col-sm-2 col-form-label">Tanggal Akan
                                        Datang</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal" id="booking-date"
                                            onclick="this.showPicker()" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <label for="session" class="col-sm-2 col-form-label">Sesi</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="sesi" id="session" required>
                                            @foreach ($jadwalArtSpace as $jadwal)
                                                <option value="{{ $jadwal->id }}">{{ $jadwal->sesi }}
                                                    {{ date('H:i', strtotime($jadwal->mulai)) }} -
                                                    {{ date('H:i', strtotime($jadwal->akhir)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="participants">
                        <tr class="participant">
                            <td class="d-lg-table-cell d-block">
                                <div class="row align-items-end">
                                    <label class="col-sm-4 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-8 ps-lg-4" style="">
                                        <input type="text" class="form-control" name="participants[][name]" required>
                                    </div>
                                </div>
                            </td>
                            <td class="d-lg-table-cell d-block">
                                <div class="row">
                                    <label class="col-sm-4 col-form-label text-lg-end">Kegiatan</label>
                                    <div class="col-sm-8">
                                        <select name="participants[][activity_id]" class="form-control">
                                            @foreach ($kegiatanArtSpace as $kegiatan)
                                                <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp
                                                    {{ number_format($kegiatan->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-secondary w-100" onclick="addParticipant()">+
                                    Tambah
                                    Peserta</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="submit" class="btn btn-primary w-100">Daftar</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            <div id="snap-container"></div>
        </div>
    </section>
</x-app>
