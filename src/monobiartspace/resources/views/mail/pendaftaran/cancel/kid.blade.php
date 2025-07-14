<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pembatalan Pendaftaran Monobi Kids</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">

                    <!-- HEADER -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Kids Logo" width="130">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 10px 30px;">
                            <h2 style="margin: 0; color: #D32F2F;">Pendaftaran Anda Telah Dibatalkan ❌</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #666;">Berikut adalah rincian
                                pendaftaran anak yang dibatalkan:</p>
                        </td>
                    </tr>

                    <!-- INFO TABLE -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="color: #333;">
                                <tr>
                                    <td style="font-weight: bold; width: 40%;">Nama Anak</td>
                                    <td>:</td>
                                    <td>{{ $data['nama_lengkap'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Nama Panggilan</td>
                                    <td>:</td>
                                    <td>{{ $data['nama_panggilan'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Kelas</td>
                                    <td>:</td>
                                    <td>{{ $data['kelas'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Kategori</td>
                                    <td>:</td>
                                    <td>{{ $data['kategori'] }}</td>
                                </tr>
                                <tr style="vertical-align: top;">
                                    <td style="font-weight: bold; vertical-align: top;">Tema</td>
                                    <td>:</td>
                                    <td>
                                        <ul style="margin: 0; padding-left: 1.2em;">
                                            @foreach ($data['tema'] as $t)
                                                <li>{{ $t }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">No. Telepon</td>
                                    <td>:</td>
                                    <td>{{ $data['no_telepon'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Status Pembayaran</td>
                                    <td>:</td>
                                    <td><span style="color: #F44336; font-weight: bold;">Dibatalkan</span></td>
                                </tr>
                            </table>

                            <hr style="margin: 25px 0; border: none; border-top: 1px solid #ddd;">

                            <!-- DETAIL PEMBAYARAN -->
                            <h4 style="margin-bottom: 10px; color: #333;">Detail Pembayaran</h4>
                            <table width="100%" cellpadding="0" cellspacing="0" style="color: #333;">
                                <tr>
                                    <td style="font-weight: bold; width: 40%;">Harga Awal</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($data['harga_awal'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Diskon</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($data['diskon'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Total Pembayaran</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;">
                                        Rp{{ number_format($data['total_pembayaran'], 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- CATATAN -->
                    <tr>
                        <td style="padding: 20px 30px;">
                            <p style="font-size: 14px; color: #666;">
                                Jika ini adalah kesalahan atau Anda ingin mendaftar kembali, silakan hubungi tim kami
                                melalui email:
                                <strong>{{ config('mail.from.address') }}</strong>.
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center" style="padding: 20px; font-size: 12px; color: #999;">
                            &copy; {{ date('Y') }} Monobi. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
