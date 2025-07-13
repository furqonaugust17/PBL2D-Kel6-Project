@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function cancelRequest() {
            Swal.fire({
                title: "Anda Yakin?",
                icon: "warning",
                text: "dana tidak bisa dikembalikan jika sudah h-2 kedatangan. apakah anda yakin?",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let uri = `{{ route('booking.cancel', ['id' => ':id']) }}`.replace(':id',
                        '{{ $data->id_pendaftaran }}')
                    $.ajax({
                        url: uri,
                        type: 'POST',
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
                            Swal.fire({
                                icon: "success",
                                title: data.message,
                            });
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
    </script>
@endsection

<x-app>
    <x-slot:title>Detail Pendaftaran</x-slot:title>
    <div class="page-title light-background">
        <div class="container">
            <h1>Detail Pendaftaran</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <table class="w-100">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ Auth::user()->customer->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td>No Pembayaran</td>
                        <td>:</td>
                        <td>{{ $data->order_id }}</td>
                    </tr>
                    <tr>
                        <td>Status Pembayaran</td>
                        <td>:</td>
                        <td>{{ $data->status_pembayaran }}</td>
                    </tr>
                    <tr>
                        <td>Status Pendaftaran</td>
                        <td>:</td>
                        <td>{{ $data->status_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Reservasi</td>
                        <td>:</td>
                        <td>{{ date('j F Y', strtotime($data->tanggal_reservasi)) }}</td>
                    </tr>
                    <tr>
                        <td>Sesi</td>
                        <td>:</td>
                        <td>{{ $data->sesi->sesi }}
                            ({{ date('G:i', strtotime($data->sesi->mulai)) . ' - ' . date('G:i', strtotime($data->sesi->akhir)) }})
                        </td>
                    </tr>
                    <tr style="vertical-align:top;">
                        <td>Kegiatan</td>
                        <td>:</td>
                        <td>
                            <ul>

                                @foreach ($data->kegiatans as $item)
                                    <li>{{ $item['nama'] }} ({{ $item['kegiatan'] }} Rp
                                        {{ number_format($item['harga'], 0, ',', '.') }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Nominal</td>
                        <td>:</td>
                        <td>Rp {{ number_format($data->harga_awal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Diskon</td>
                        <td>:</td>
                        <td>Rp {{ number_format($data->diskon, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Total Pembayaran</td>
                        <td>:</td>
                        <td>Rp {{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            @if ($data->status_pendaftaran != 'ajukan batal' && $data->status_pendaftaran != 'batal')
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger" onclick="cancelRequest()">Batalkan</button>
                </div>
            @endif
        </div>
    </section>
</x-app>
