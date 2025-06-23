<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Notifikasi Pembatalan Pendaftaran</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td align="center" style="background-color: #d32f2f; padding: 20px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo"
                                style="max-width: 180px;">
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 20px 30px;">
                            <h2 style="margin: 0;">Permintaan Pembatalan Pendaftaran</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo Admin,</p>
                            <p>Berikut adalah detail customer yang mengajukan permintaan <strong>pembatalan
                                    pendaftaran</strong>:</p>

                            <table width="100%" cellpadding="5" style="margin-top: 10px;">
                                <tr>
                                    <td><strong>Order ID</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->pembayaran->order_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Lengkap</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No Telepon</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->notelp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Pendaftaran</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ ucfirst($data->type) }}</td>
                                </tr>
                                @if ($data->type == 'artspace')
                                    <tr>
                                        <td><strong>Tanggal Reservasi</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($data->tanggal_reservasi)->format('d F Y') }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Nominal</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>Rp {{ number_format($data->pembayaran->amount, 0, ',', '.') }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 30px;">Silakan tinjau permintaan ini melalui sistem admin sesegera
                                mungkin.</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px;">
                            <p>Terima kasih.</p>
                            <p><strong>Tim {{ config('app.name') }}</strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 20px; font-size: 12px; color: #999;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
