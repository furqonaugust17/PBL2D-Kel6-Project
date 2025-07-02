<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Perubahan Data Akun Customer</title>
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
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="130">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 10px 30px;">
                            <h2 style="margin: 0; color: #333333;">Informasi Akun Anda Telah Diperbarui</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #666;">
                                Berikut adalah data terbaru dari akun Anda di <strong>{{ config('app.name') }}</strong>:
                            </p>
                        </td>
                    </tr>

                    <!-- INFO CUSTOMER -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="color: #333;">
                                <tr>
                                    <td style="font-weight: bold; width: 40%;">Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Username</td>
                                    <td>:</td>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Email</td>
                                    <td>:</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">No. Telepon</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->notelp }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Alamat</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->alamat }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{ $data->customer->jk == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                            </table>

                            <hr style="margin: 25px 0; border: none; border-top: 1px solid #ddd;">

                            <!-- FOOTER INFO -->
                            <p style="font-size: 14px; color: #666;">
                                Jika Anda tidak merasa melakukan perubahan ini atau terdapat kesalahan pada data,
                                silakan hubungi kami di
                                <a href="mailto:{{ config('mail.from.address') }}"
                                    style="color: #1976d2;">{{ config('mail.from.address') }}</a>.
                            </p>

                            <p style="font-size: 14px; color: #666;">Terima kasih telah menjadi bagian dari
                                {{ config('app.name') }}.</p>

                            <p style="margin-top: 30px; font-size: 14px; color: #555;">
                                Salam hangat,<br>
                                <strong>Tim {{ config('app.name') }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
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
