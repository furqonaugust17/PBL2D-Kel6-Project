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

                    <!-- HEADER -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #f44336;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="130">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 20px 30px;">
                            <h2
                                style="margin: 0; color: #ffffff; background-color: #f44336; padding: 10px; border-radius: 6px;">
                                Permintaan Pembatalan Pendaftaran
                            </h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #666;">
                                Pelanggan mengajukan permintaan pembatalan pendaftaran. Berikut datanya:
                            </p>
                        </td>
                    </tr>

                    <!-- ISI -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="color: #333;">
                                <tr>
                                    <td style="font-weight: bold; width: 40%;">Order ID</td>
                                    <td>:</td>
                                    <td>{{ $data->pembayaran->order_id }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Email</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->user->email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">No Telepon</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->notelp }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Jenis Pendaftaran</td>
                                    <td>:</td>
                                    <td>{{ ucfirst($data->type) }}</td>
                                </tr>
                                @if ($data->type == 'artspace')
                                    <tr>
                                        <td style="font-weight: bold;">Tanggal Reservasi</td>
                                        <td>:</td>
                                        <td>{{ \Carbon\Carbon::parse($data->tanggal_reservasi)->format('d F Y') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="font-weight: bold;">Nominal</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($data->pembayaran->amount, 0, ',', '.') }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 30px; font-size: 14px;">
                                Mohon segera tindak lanjuti pembatalan ini melalui sistem admin.
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding: 20px;">
                            <p>Terima kasih.</p>
                            <p>Salam hangat,<br><strong>Tim {{ config('app.name') }}</strong></p>
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
