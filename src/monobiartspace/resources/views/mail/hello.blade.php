{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Terima Kasih telah bergabung menjadi partner kami </title>
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
                            <img src="{{ asset('images/header-image.png') }}" alt="Header Image" width="100%"
                                style="max-width: 600px;">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding: 20px 30px;">
                            <h2>Selamat Bergabung di Monobi ArtSpace!</h2>
                        </td>
                    </tr>

                    <!-- DATA -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo {{ $data['name'] }},</p>
                            <p>Terima kasih telah memilih Monobi ArtSpace sebagai tempat untuk mengembangkan kreativitas dan bakat seni Anda. Kami sangat senang dapat menyambut Anda sebagai bagian dari komunitas seni kami.</p>
                            
                            <p>Berikut adalah detail informasi keanggotaan Anda:</p>
                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td width="30%"><strong>Nama Lengkap</strong></td>
                                    <td width="5%"><strong>:</strong></td>
                                    <td>{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No Telepon</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['no_telepon'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Keanggotaan</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['status_pembayaran'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr style="border: none; border-top: 1px solid #ccc; margin: 20px 0;">
                                        <h4 style="margin: 0 0 10px 0;">Kegiatan Yang Dipilih</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;"><strong>Program</strong></td>
                                    <td style="vertical-align: top;"><strong>:</strong></td>
                                    <td>
                                        <ul style="list-style-type: '- '; padding-left: 1.2em; margin:0;">
                                            @foreach ($data['kegiatans'] as $kegiatan)
                                                <li>{{ $kegiatan['nama'] }}
                                                    ({{ $kegiatan['kegiatan'] . ' Rp ' . number_format($kegiatan['harga'], 0, ',', '.') }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Diskon</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>Rp {{ number_format($data['diskon'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Pembayaran</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>Rp {{ number_format($data['total_pembayaran'], 0, ',', '.') }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 20px;">Kami berharap Anda akan mendapatkan pengalaman yang menyenangkan dan bermanfaat selama mengikuti program di Monobi ArtSpace. Jika ada pertanyaan atau bantuan yang Anda butuhkan, jangan ragu untuk menghubungi kami.</p>
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    @if ($data['status_pembayaran'] == 'pending')
                        <tr>
                            <td align="center" style="padding: 20px;">
                                <a href="{{ $data['snap_url'] }}"
                                    style="background-color: #1976d2; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; display: inline-block;">Bayar
                                    Sekarang</a>
                            </td>
                        </tr>
                    @endif

                    <!-- FOOTER -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #f8f9fa; color: #6c757d;">
                            <p style="margin: 0;">© 2023 Monobi ArtSpace. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html> --}}