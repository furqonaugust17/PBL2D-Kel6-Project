<x-app>
    <x-slot:title>Pembayaran {{ $data['status_pembayaran'] }}</x-slot:title>
    <div class="page-title light-background">
        <div class="container">
            <h1>Status Pembayaran</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            @if ($type == 'artspace')
                <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px;">
                    <tr>
                        <td align="center">
                            <table width="auto" cellpadding="0" cellspacing="0"
                                style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 0 30px 20px;">
                                        <table width="100%" cellpadding="5">
                                            <tbody class="align-top">
                                                <tr>
                                                    <td><strong>Order ID</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td>{{ $data['order_id'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Pembayaran</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td>{{ $data['status_pembayaran'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Pendaftaran</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td>{{ $data['status_pendaftaran'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top;"><strong>Kegiatan</strong></td>
                                                    <td style="vertical-align: top;"><strong>:</strong></td>
                                                    <td>
                                                        <ul
                                                            style="list-style-type: '- '; padding-left: 1.2em; margin:0;">
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
                                                    <td>Rp {{ number_format($data['total_pembayaran'], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                @if ($data['status_pembayaran'] == 'pending')
                                    <tr>
                                        <td align="end" style="padding: 20px;">
                                            <a href="{{ $data['snap_url'] }}"
                                                style="background-color: #1976d2; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none;">Bayar
                                                Sekarang</a>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                </table>
            @else
                <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px;">
                    <tr>
                        <td align="center">
                            <table width="auto" cellpadding="0" cellspacing="0"
                                style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 0 30px 20px;">
                                        <table width="100%" cellpadding="5">
                                            <tbody class="align-top">
                                                <tr>
                                                    <td><strong>Order ID</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td>{{ $data['order_id'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Pembayaran</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td>{{ $data['status_pembayaran'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Pendaftaran</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td>{{ $data['status_pendaftaran'] }}</td>
                                                </tr>
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
                                                    <td class="align-top"><strong>Tema</strong></td>
                                                    <td class="align-top"><strong>:</strong></td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($data['tema'] as $t)
                                                                <li>{{ $t }}</li>
                                                            @endforeach
                                                        </ul>
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
                                                    <td>Rp {{ number_format($data['total_pembayaran'], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                @if ($data['status_pembayaran'] == 'pending')
                                    <tr>
                                        <td align="end" style="padding: 20px;">
                                            <a href="{{ $data['snap_url'] }}"
                                                style="background-color: #1976d2; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none;">Bayar
                                                Sekarang</a>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                </table>
            @endif
        </div>
    </section>
</x-app>
