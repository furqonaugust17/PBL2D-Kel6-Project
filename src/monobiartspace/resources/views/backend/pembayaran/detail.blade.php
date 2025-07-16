<x-app-layout>
    <x-slot:title>Detail Pembayaran</x-slot:title>
    <div class="row">
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="link-primary" href="{{ route('pembayaran.index') }}"><i class="fas fa-arrow-left"></i>
                            Kembali Ke Halaman
                            Pembayaran</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <h3>Data Customer</h3>
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td>Nama Customer</td>
                                        <td>:</td>
                                        <td>{{ $data->pendaftaran->customer->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telepon</td>
                                        <td>:</td>
                                        <td>{{ $data->pendaftaran->customer->notelp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $data->pendaftaran->customer->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $data->pendaftaran->customer->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-12">
                            <h3>Pembayaran</h3>
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td>Order Id</td>
                                        <td>:</td>
                                        <td>{{ $data->order_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $data->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $data->payment_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Metode Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $data->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nominal</td>
                                        <td>:</td>
                                        <td>{{ number_format($data->pendaftaran->nominal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diskon</td>
                                        <td>:</td>
                                        <td>{{ number_format($data->pendaftaran->diskon, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ number_format($data->amount, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
