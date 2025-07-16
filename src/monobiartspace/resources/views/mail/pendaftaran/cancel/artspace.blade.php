<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pembatalan Pendaftaran Monobi Art Space</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #eeeeee; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 30px 20px 10px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="160"
                                style="margin-bottom: 10px;">
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td align="center" style="padding: 0 30px;">
                            <h2 style="color: #D32F2F; margin: 0;">Pendaftaranmu Telah Dibatalkan ❌</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #555;">
                                Pendaftaranmu di <strong>Monobi Art Space</strong> telah dibatalkan. Berikut detail
                                informasinya:
                            </p>
                        </td>
                    </tr>

                    <!-- Informasi Peserta -->
                    <tr>
                        <td style="padding: 20px 30px;">
                            <table width="100%" style="font-size: 14px; color: #444;">
                                <tr>
                                    <td width="180"><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td>{{ $data['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Telepon</strong></td>
                                    <td>:</td>
                                    <td>{{ $data['no_telepon'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Pendaftaran</strong></td>
                                    <td>:</td>
                                    <td><span style="color: #F44336; font-weight: bold;">Dibatalkan</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Reservasi</strong></td>
                                    <td>:</td>
                                    <td>{{ date('j F Y', strtotime($data['tanggal_reservasi'])) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Sesi</strong></td>
                                    <td>:</td>
                                    <td>{{ $data['sesi']->sesi }} ({{ date('H:i', strtotime($data['sesi']->mulai)) }} -
                                        {{ date('H:i', strtotime($data['sesi']->akhir)) }})</td>
                                </tr>
                            </table>

                            <hr style="border: none; border-top: 1px solid #ddd; margin: 25px 0;">

                            <h4 style="margin-bottom: 10px; font-size: 16px; color: #000;">Detail Kegiatan & Pembayaran
                            </h4>

                            <table width="100%" style="font-size: 14px; color: #444;">
                                <tr style="vertical-align: top;">
                                    <td width="180"><strong>Kegiatan</strong></td>
                                    <td>:</td>
                                    <td>
                                        <ul style="padding-left: 20px; margin: 0;">
                                            @foreach ($data['kegiatans'] as $kegiatan)
                                                <li>{{ $kegiatan['nama'] }} ({{ $kegiatan['kegiatan'] }} - Rp
                                                    {{ number_format($kegiatan['harga'], 0, ',', '.') }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Diskon</strong></td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($data['diskon'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Pembayaran</strong></td>
                                    <td>:</td>
                                    <td><strong>Rp {{ number_format($data['total_pembayaran'], 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; font-size: 12px; color: #999;">
                            Jika kamu tidak pernah melakukan pendaftaran ini atau ingin mendaftar ulang, silakan hubungi
                            kami.<br>
                            &copy; {{ date('Y') }} Monobi. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
