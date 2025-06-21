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
                        <td align="center" style="background-color: #1976d2; padding: 20px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Header Image" width="100%"
                                style="max-width: 600px;">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 20px 30px;"><strong>Verifikasi Email</strong></td>
                    </tr>

                    <!-- DATA -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo {{ $data->customer->nama_lengkap }},</p>
                            <p>Selamat! Akun Anda telah berhasil didaftarkan di {{ config('app.name') }}.</p>
                            <p>Berikut adalah informasi akun Anda:</p>
                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td><strong>Nama Lengkap</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Username</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No Telepon</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->notelp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->alamat }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px;">
                            <p>Untuk mulai menggunakan layanan kami, silakan lakukan verifikasi email dengan mengklik
                                tautan di bawah ini:</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ $url }}"
                                style="background-color: #1976d2; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none;">Verifikasi
                                Email</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p>Jika Anda merasa tidak pernah melakukan pendaftaran ini, Anda bisa mengabaikan email ini.
                                Akun tidak akan aktif sepenuhnya tanpa verifikasi email.
                            </p>
                            <p>Jika Anda memiliki pertanyaan atau butuh bantuan, hubungi kami di {{ $email }}.
                            </p>
                            <p>Terima kasih telah bergabung!</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p>Salam hangat,
                                <strong>Tim {{ config('app.name') }}</strong>
                            </p>
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
