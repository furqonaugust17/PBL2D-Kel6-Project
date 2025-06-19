<x-app-layout>
    <x-slot:title>Detail Pendaftaran</x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <h2>Pembayaran</h2>
                            <table>
                                <tr>
                                    <td>Order ID</td>
                                    <td>:</td>
                                    <td>{{ $data->order_id }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Customer</td>
                                    <td>:</td>
                                    <td>{{ $data->nama_orang_tua }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td>:</td>
                                    <td>{{ $data->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $data->status_pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Nominal</td>
                                    <td>:</td>
                                    <td>{{ number_format($data->harga_awal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td>{{ number_format($data->diskon, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-6">
                            <h2>Pendaftaran</h2>
                            <table>
                                <tr>
                                    <td>Status Pendaftaran</td>
                                    <td>:</td>
                                    <td>{{ $data->status_pendaftaran }}</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>{{ $data->kelas }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td>{{ $data->kategori }}</td>
                                </tr>
                                <tr>
                                    <td>Judul Tema</td>
                                    <td>:</td>
                                    <td>{{ $data->judul_tema }}</td>
                                </tr>
                                <tr class="align-top">
                                    <td>Tema</td>
                                    <td>:</td>
                                    <td>
                                        <ul>
                                            @foreach ($data->tema as $tema)
                                                <li>{{ $tema }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12">
                            <h2>Data Anak</h2>
                            <table>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $data->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Panggilan</td>
                                    <td>:</td>
                                    <td>{{ $data->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ date('d F Y', strtotime($data->tgl_lahir)) }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Usia Saat Daftar Kelas</td>
                                    <td>:</td>
                                    <td>{{ date('d F Y', strtotime($data->nama_lengkap)) }}</td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
