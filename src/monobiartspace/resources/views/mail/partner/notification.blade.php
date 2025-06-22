<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Notifikasi Partner</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #1976d2; padding: 20px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Logo" style="max-width: 200px;">
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td align="center" style="padding: 20px 30px;">
                            <strong>{{ $title }}</strong>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo {{ $data->name ?? '-' }},</p>
                            <p>{{ $messageLine }}</p>

                            <p>Berikut adalah informasi akun Anda:</p>
                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td><strong>Nama Lengkap</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No Telepon</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data->description ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px;">
                            <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi kami di
                                {{ config('mail.from.address') }}.</p>
                            <p>Terima kasih telah bergabung dengan kami.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p>Salam hangat, <br><strong>Tim {{ config('app.name') }}</strong></p>
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
