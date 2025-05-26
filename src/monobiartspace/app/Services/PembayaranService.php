<?php

namespace App\Services;

use App\Models\PembayaranBooking;

class PembayaranService
{

    public static function makeMailDataKids(String $order_id)
    {
        $pembayaran = PembayaranBooking::with([
            'pendaftaran.customer.user',
            'pendaftaran.detailPendaftaranKid.children',
            'pendaftaran.detailPendaftaranKid.jadwalKid.kategori.kid',
            'pendaftaran.detailPendaftaranKid.jadwalKid.kategori',
            'pendaftaran.detailPendaftaranKid.detailPendaftaranTema.tema'
        ])->where('order_id', $order_id)->firstOrFail();;
        $pendaftaran = $pembayaran->pendaftaran;
        $detailKid = optional($pendaftaran)->detailPendaftaranKid;

        $temaList = optional($detailKid)->detailPendaftaranTema?->map(function ($dpt) {
            $tema = $dpt->tema;
            return $tema ? "{$tema->nama} (Week {$tema->week})" : null;
        })->filter()->values()->toArray();

        return [
            'nama_orang_tua'      => optional($pendaftaran->customer)->nama_lengkap,
            'email'               => optional($pendaftaran->customer)->user->email,
            'nama_lengkap'        => optional($detailKid->children)->nama_lengkap,
            'nama_panggilan'      => optional($detailKid->children)->panggilan,
            'kelas'               => optional(optional($detailKid->jadwalKid)?->kategori?->kid)->nama,
            'kategori'            => optional($detailKid->jadwalKid?->kategori)->nama,
            'tema'                => $temaList,
            'no_telepon'          => optional($pendaftaran->customer)->notelp,
            'status_pembayaran'   => $pembayaran->status ?? 'Pending',
            'snap_url'            => $pembayaran->snap_url,
            'harga_awal'          => $pembayaran->harga_awal,
            'diskon'              => $pembayaran->diskon,
            'total_pembayaran'    => $pembayaran->amount
        ];
    }

    public static function makeMailDataArtSpace(String $order_id)
    {
        $pembayaran = PembayaranBooking::with(['pendaftaran.customer.user', 'pendaftaran.detailPendaftaran.kegiatans'])->where('order_id', $order_id)->firstOrFail();
        $pendaftaran = $pembayaran->pendaftaran;
        $detailPendaftaran = optional($pendaftaran)->detailPendaftaran;
        $kegiatans = $detailPendaftaran?->map(function ($kegiatan) {
            return ['nama'  => $kegiatan->nama_peserta, 'kegiatan' => $kegiatan->kegiatans->nama, 'harga' => $kegiatan->kegiatans->harga];
        })->values()->toArray();

        return [
            'nama'      => optional($pendaftaran->customer)->nama_lengkap,
            'email'                 => optional($pendaftaran->customer)->user->email,
            'no_telepon'          => optional($pendaftaran->customer)->notelp,
            'kegiatans' => $kegiatans,
            'status_pembayaran'   => $pembayaran->status ?? 'Pending',
            'snap_url'            => $pembayaran->snap_url,
            'harga_awal'          => $pembayaran->harga_awal,
            'diskon'              => $pembayaran->diskon,
            'total_pembayaran'    => $pembayaran->amount
        ];
    }
}
