@section('script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                console.log(participants);
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
                        participants
                    },
                    success: function(data) {
                        console.log(data);
                        // window.snap.pay(`${data.snapToken}`);
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
                            <td>Tanggal Booking</td>
                            <td>:</td>
                            <td id="tgl-booking">${tanggal}</td>
                        </tr>
                        <tr>
                            <td>Sesi</td>
                            <td>:</td>
                            <td id="sesi">${$(
                                `select[name="sesi"] option[value="${sesi}"]`).html()}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Kegiatan</td>
                            <td>:</td>
                            <td id="kegiatan">
                                 <ul class="m-0" style="list-style-type: '- '; padding-left: 1.2em;">${ participants.map((value, index) => `
                                    <li>${value.name} (${data.data.find(element => element.id === `activity_${value.activity_id}`).name} ${data.data.find(element => element.id === `activity_${value.activity_id}`).price} )</li>
                                    `).join('')}
                                </ul>
                            </td>
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
                                    url: "{{ route('booking.artspace.store') }}",
                                    type: "POST",
                                    data: {
                                        tanggal,
                                        sesi,
                                        participants
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
                console.log({
                    tanggal,
                    sesi,
                    participants
                });

            })
        });


        let counterParticipant = 1;

        function addParticipant() {
            const container = document.getElementById('participants');
            const html = `
        <tr class="participant">
            <td>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Nama Peserta</label>
                    <div class="col-sm-8" style="padding-left: 1.4rem !important;">
                        <input type="text" class="form-control" name="participants[][name]"
                            required>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <label class="col-sm-4 col-form-label text-end">Kegiatan</label>
                    <div class="col-sm-8">
                        <select name="participants[][activity_id]" class="form-control">
                            @foreach ($kegiatanArtSpace as $kegiatan)
                                <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp
                                    {{ $kegiatan->harga }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </td>
            <td>
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
                                            onclick="this.showPicker()">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <label for="session" class="col-sm-2 col-form-label">Sesi</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="sesi" id="session">
                                            @foreach ($jadwalArtSpace as $jadwal)
                                                <option value="{{ $jadwal->id }}">{{ $jadwal->sesi }}
                                                    {{ $jadwal->mulai }} -
                                                    {{ $jadwal->akhir }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="participants">
                        <tr class="participant">
                            <td>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-8" style="padding-left: 1.4rem !important;">
                                        <input type="text" class="form-control" name="participants[][name]" required>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label text-end">Kegiatan</label>
                                    <div class="col-sm-8">
                                        <select name="participants[][activity_id]" class="form-control">
                                            @foreach ($kegiatanArtSpace as $kegiatan)
                                                <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp
                                                    {{ $kegiatan->harga }}
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
