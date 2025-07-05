@section('css')
    <link href="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="status"]').on('change', function() {
                Swal.fire({
                    title: "Anda Yakin?",
                    text: "Status Pendaftaran Akan Diubah",
                    type: "warning",
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ubah",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: `{{ route('pendaftaran.status', ['pendaftaran' => ':id']) }}`
                                .replace(':id',
                                    '{{ $data->id_pendaftaran }}'),
                            type: 'POST',
                            data: {
                                status: $(this).val()
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
                            success: function(result) {
                                Swal.close();
                                Swal.fire({
                                    title: "Berhasil",
                                    text: "Pendaftaran Berhasil Diubah",
                                    type: "success",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Oke",
                                })
                            },
                            error: function(xhr, status, error) {
                                Swal.close();
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: xhr.responseJSON
                                        .message,
                                });
                            }
                        })
                    } else {
                        Swal.fire({
                            title: "Batal",
                            text: "Status Tidak Diubah",
                            type: "success",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Oke",
                        })
                        $('select[name="status"]').val("{{ $data->status_pendaftaran }}")
                            .selectpicker('refresh');
                    }
                });
            })
        })
    </script>
@endsection
<x-app-layout>
    <x-slot:title>Detail Pendaftaran</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <h2>Pembayaran</h2>
                            <table>
                                <tr>
                                    <td>Order ID</td>
                                    <td>:</td>
                                    <td class="px-2">{{ $data->order_id }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Customer</td>
                                    <td>:</td>
                                    <td class="px-2">{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td class="px-2">{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td>:</td>
                                    <td class="px-2">{{ $data->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>:</td>
                                    <td class="px-2">{{ $data->status_pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Nominal</td>
                                    <td>:</td>
                                    <td class="px-2">{{ number_format($data->harga_awal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td class="px-2">{{ number_format($data->diskon, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <td>:</td>
                                    <td class="px-2">{{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-12">
                            <h2>Pendaftaran</h2>
                            <table>
                                <tr>
                                    <td>Status Pendaftaran</td>
                                    <td>:</td>
                                    <td>
                                        <select name="status" id="status"
                                            class="default-select form-control-sm w-100 h-auto"
                                            {{ $data->status_pendaftaran == 'batal' ? 'disabled' : '' }}>
                                            <option value="menunggu pembayaran"
                                                {{ $data->status_pendaftaran == 'menunggu pembayaran' ? 'selected' : '' }}
                                                disabled>Menunggu Pembayaran
                                            </option>
                                            <option value="menunggu kedatangan"
                                                {{ $data->status_pendaftaran == 'menunggu kedatangan' ? 'selected' : '' }}
                                                disabled>Menunggu Kedatang
                                            </option>
                                            <option value="ajukan batal"
                                                {{ $data->status_pendaftaran == 'ajukan batal' ? 'selected' : '' }}
                                                disabled>Ajukan Batal
                                            </option>
                                            <option value="datang"
                                                {{ $data->status_pendaftaran == 'datang' ? 'selected' : '' }}>Datang
                                            </option>
                                            <option value="batal"
                                                {{ $data->status_pendaftaran == 'batal' ? 'selected' : '' }}>Batal
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Reservasi</td>
                                    <td>:</td>
                                    <td class="px-2">{{ date('j F Y', strtotime($data->tanggal_reservasi)) }}</td>
                                </tr>
                                <tr class="align-top">
                                    <td>Peserta</td>
                                    <td>:</td>
                                    <td class="px-2">
                                        <ul>
                                            @foreach ($data->kegiatans as $peserta)
                                                <li>{{ $peserta['nama'] }} ({{ $peserta['kegiatan'] }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
