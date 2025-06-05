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
                        success: function(result) {
                            console.log(result);
                        }
                    })
                }
            })
        }
    </script>
@endsection
<x-app>
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
                        <td>Nama Anak</td>
                        <td>:</td>
                        <td>{{ $data->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td>Nama Anak Panggilan</td>
                        <td>:</td>
                        <td>{{ $data->nama_panggilan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir Anak</td>
                        <td>:</td>
                        <td>{{ date('j F Y', strtotime($data->tgl_lahir)) }}</td>
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
                        <td>Kelas</td>
                        <td>:</td>
                        <td>
                            {{ $data->kelas }}
                        </td>
                    </tr>
                    <tr style="vertical-align:top;">
                        <td>Tema</td>
                        <td>:</td>
                        <td>
                            <ul>
                                @foreach ($data->tema as $t)
                                    <li>{{ $t }}</li>
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
