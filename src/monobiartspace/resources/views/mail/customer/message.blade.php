<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pesan Kontak Pelanggan</title>
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
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="100%"
                                style="max-width: 600px;">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 20px 30px;">
                            <strong>Pesan Baru dari Pelanggan</strong>
                        </td>
                    </tr>

                    <!-- ISI PESAN -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo Admin,</p>
                            <p>Berikut ini adalah pesan yang dikirim melalui formulir kontak website:</p>

                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['email'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Subjek</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['subject'] }}</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>Pesan</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td>{{ $data['message'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding: 20px;">
                            <p>Silakan balas langsung ke email <strong>{{ $data['email'] }}</strong> untuk merespons
                                pesan ini.</p>
                            <p>Terima kasih telah menggunakan layanan kami.</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px;">
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
