<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
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
                            <h2 style="margin: 0; color: #333333;">{{ $title }}</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #666;">{{ $messageLine }}</p>
                        </td>
                    </tr>

                    <!-- INFO TABLE -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <h4 style="margin-bottom: 10px; color: #333;">Informasi Akun Partner</h4>
                            <table width="100%" cellpadding="0" cellspacing="0" style="color: #333;">
                                <tr>
                                    <td style="font-weight: bold; width: 40%;">Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $data->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Email</td>
                                    <td>:</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">No. Telepon</td>
                                    <td>:</td>
                                    <td>{{ $data->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Deskripsi</td>
                                    <td>:</td>
                                    <td>{{ $data->description ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER SUPPORT -->
                    <tr>
                        <td style="padding: 25px 30px 0 30px; font-size: 14px; color: #666;">
                            Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi kami di
                            <a href="mailto:{{ config('mail.from.address') }}"
                                style="color: #1976d2; text-decoration: none;">
                                {{ config('mail.from.address') }}
                            </a>.
                            <br><br>
                            Terima kasih telah bergabung bersama kami.
                        </td>
                    </tr>

                    <!-- SALAM -->
                    <tr>
                        <td style="padding: 10px 30px 20px 30px; font-size: 14px; color: #666;">
                            Salam hangat,<br>
                            <strong>Tim {{ config('app.name') }}</strong>
                        </td>
                    </tr>

                    <!-- COPYRIGHT -->
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
