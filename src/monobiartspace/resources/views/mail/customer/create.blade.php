<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
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
                            <h2 style="margin: 0; color: #333333;">Verifikasi Email Anda</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #666;">
                                Selamat datang di <strong>{{ config('app.name') }}</strong>! Akun Anda telah berhasil
                                dibuat.
                            </p>
                        </td>
                    </tr>

                    <!-- INFO AKUN -->
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
                            </table>

                            <hr style="margin: 25px 0; border: none; border-top: 1px solid #ddd;">

                            <p style="font-size: 14px; color: #555;">
                                Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini untuk memverifikasi
                                email:
                            </p>
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    <tr>
                        <td align="center" style="padding: 25px;">
                            <a href="{{ $url }}"
                                style="background-color: #1976d2; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                                Verifikasi Email
                            </a>
                        </td>
                    </tr>

                    <!-- INFO LANJUTAN -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p style="font-size: 14px; color: #666;">
                                Jika Anda tidak merasa melakukan pendaftaran ini, Anda dapat mengabaikan email ini.
                                Akun tidak akan aktif sepenuhnya tanpa proses verifikasi.
                            </p>

                            <p style="font-size: 14px; color: #666;">
                                Jika Anda memiliki pertanyaan, silakan hubungi kami di
                                <a href="mailto:{{ config('mail.from.address') }}" style="color: #1976d2;">
                                    {{ config('mail.from.address') }}
                                </a>.
                            </p>

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
