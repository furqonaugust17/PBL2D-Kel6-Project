<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Perbarui Data</title>
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
                        <td align="center" style="padding: 20px 30px;"><strong>Informasi Akun Anda Telah
                                Diperbarui</strong></td>
                    </tr>

                    <!-- DATA -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo {{ $data->customer->nama_lengkap }},</p>
                            <p>Kami ingin memberi tahu bahwa data akun Anda di {{ config('app.name') }} telah berhasil
                                diperbarui. Berikut adalah rincian terbaru yang tercatat:</p>
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
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->customer->jk == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p>Jika Anda merasa tidak pernah melakukan perubahan ini atau terdapat kesalahan, silakan
                                segera hubungi tim kami melalui email: {{ $email }}.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p>Terima kasih telah menjadi bagian dari komunitas kami.
                                Salam hangat,
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
