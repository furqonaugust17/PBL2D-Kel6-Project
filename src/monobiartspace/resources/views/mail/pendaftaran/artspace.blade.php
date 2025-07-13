<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pendaftaran</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #eeeeee; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 30px 20px 10px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="160"
                                style="margin-bottom: 10px;">
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td align="center" style="padding: 0 30px;">
                            @if ($data['status_pembayaran'] == 'pending')
                                <h2 style="color: #333; margin: 0;">Konfirmasi Pendaftaran</h2>
                            @elseif ($data['status_pembayaran'] == 'settlement')
                                <h2 style="color: #333; margin: 0;">Yeay! Kamu Berhasil Terdaftar 🎉</h2>
                            @endif
                            <p style="margin-top: 10px; font-size: 15px; color: #555;">Terima kasih telah mendaftar di
                                <strong>Monobi ArtSpace</strong>. Berikut detail pendaftaranmu:
                            </p>
                        </td>
                    </tr>

                    <!-- Informasi Peserta -->
                    <tr>
                        <td style="padding: 20px 30px;">
                            <table width="100%" style="font-size: 14px; color: #444;">
                                <tr>
                                    <td width="180"><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td>{{ $data['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Telepon</strong></td>
                                    <td>:</td>
                                    <td>{{ $data['no_telepon'] }}</td>
                                </tr>
                                @php
                                    $status = strtolower($data['status_pembayaran']);
                                    $statusColor = match ($status) {
                                        'settlement' => '#4CAF50',
                                        'pending' => '#FFA000',
                                        'expire', 'failed' => '#F44336',
                                        default => '#333',
                                    };
                                @endphp
                                <tr>
                                    <td><strong>Status Pembayaran</strong></td>
                                    <td>:</td>
                                    <td><span
                                            style="color: {{ $statusColor }}; font-weight: bold;">{{ ucfirst($status) }}</span>
                                    </td>
                                </tr>

                            </table>

                            <hr style="border: none; border-top: 1px solid #ddd; margin: 25px 0;">

                            <h4 style="margin-bottom: 10px; font-size: 16px; color: #000;">Detail Kegiatan & Pembayaran
                            </h4>

                            <table width="100%" style="font-size: 14px; color: #444;">
                                <tr style="vertical-align: top;">
                                    <td width="180"><strong>Kegiatan</strong></td>
                                    <td>:</td>
                                    <td>
                                        <ul style="padding-left: 20px; margin:0;">
                                            @foreach ($data['kegiatans'] as $kegiatan)
                                                <li>{{ $kegiatan['nama'] }} ({{ $kegiatan['kegiatan'] }} - Rp
                                                    {{ number_format($kegiatan['harga'], 0, ',', '.') }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Diskon</strong></td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($data['diskon'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Pembayaran</strong></td>
                                    <td>:</td>
                                    <td><strong>Rp
                                            {{ number_format($data['total_pembayaran'], 0, ',', '.') }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Tombol Pembayaran -->
                    @if ($data['status_pembayaran'] == 'pending')
                        <tr>
                            <td align="center" style="padding: 20px 30px;">
                                <a href="{{ $data['snap_url'] }}"
                                    style="display: inline-block; background-color: #1976d2; color: #fff; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                                    Bayar Sekarang
                                </a>
                            </td>
                        </tr>
                    @endif

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; font-size: 12px; color: #999;">
                            Jika Anda tidak merasa mendaftarkan anak ke Monobi Kids, abaikan email ini.<br>
                            &copy; {{ date('Y') }} Monobi. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
