<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pendaftaran</title>
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
                            <h2 style="margin: 0; color: #333;">
                                @if ($data['status_pembayaran'] == 'pending')
                                    <strong>Konfirmasi Pendaftaran</strong>
                                @elseif($data['status_pembayaran'] == 'settlement')
                                    <strong>Berhasil Terdaftar</strong>
                                @endif
                            </h2>
                        </td>
                    </tr>

                    <!-- DATA -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <p>Halo {{ $data['nama_orang_tua'] }},</p>
                            <p>Berikut adalah informasi pendaftaran anak Anda:</p>
                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td><strong>Nama Anak</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['nama_lengkap'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Panggilan</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['nama_panggilan'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kelas</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['kelas'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['kategori'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tema</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>
                                        <ul>
                                            @foreach ($data['tema'] as $t)
                                                <li>{{ $t }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>No Telepon</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['no_telepon'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Pembayaran</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>{{ $data['status_pembayaran'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr style="border: none; border-top: 1px solid #ccc; margin: 20px 0;">
                                        <h4 style="margin: 0 0 10px 0;">Detail Pembayaran</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Harga Awal</strong></td>
                                    <td><strong>:</strong></td>
                                    <td>Rp {{ number_format($data['harga_awal'], 0, ',', '.') }}</td>
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
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    @if ($data['status_pembayaran'] == 'pending')
                        <tr>
                            <td align="center" style="padding: 20px;">
                                <a href="{{ $data['snap_url'] }}"
                                    style="background-color: #1976d2; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none;">Bayar
                                    Sekarang</a>
                            </td>
                        </tr>
                    @endif

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
