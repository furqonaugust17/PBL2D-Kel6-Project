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
                        <td align="center" style="padding: 20px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="130">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 10px 30px;">
                            <h2 style="margin: 0; color: #333333;">Pesan Baru dari Pelanggan</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #666;">
                                Formulir kontak website telah diisi oleh pelanggan. Berikut detailnya:
                            </p>
                        </td>
                    </tr>

                    <!-- ISI PESAN -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="color: #333;">
                                <tr>
                                    <td style="font-weight: bold; width: 30%;">Nama</td>
                                    <td>:</td>
                                    <td>{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Email</td>
                                    <td>:</td>
                                    <td>{{ $data['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Subjek</td>
                                    <td>:</td>
                                    <td>{{ $data['subject'] }}</td>
                                </tr>
                                <tr style="vertical-align: top;">
                                    <td style="font-weight: bold;">Pesan</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="white-space: pre-line;">{{ $data['message'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- CTA -->
                    <tr>
                        <td style="padding: 25px 30px 0 30px;">
                            <p style="font-size: 14px;">
                                Anda dapat langsung membalas ke email pelanggan melalui: <br>
                                <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding: 20px;">
                            <p>Terima kasih telah menggunakan layanan kami.</p>
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
