<?php

namespace App\Services;

use App\Models\PembayaranBooking;

class PembayaranService
{

    public static function getDataPembayaranKids(String $order_id)
    {
        $pembayaran = PembayaranBooking::with([
            'pendaftaran.customer.user',
            'pendaftaran.detailPendaftaranKid.children',
            'pendaftaran.detailPendaftaranKid.jadwalKid.kategori.kid',
            'pendaftaran.detailPendaftaranKid.jadwalKid.kategori',
            'pendaftaran.detailPendaftaranKid.detailPendaftaranTema.tema.tema'
        ])->where('order_id', $order_id)->firstOrFail();;
        $pendaftaran = $pembayaran->pendaftaran;
        $detailKid = optional($pendaftaran)->detailPendaftaranKid;

        $temaList = optional($detailKid)->detailPendaftaranTema?->map(function ($dpt) {
            $tema = $dpt->tema;
            return $tema ? "{$tema->nama} (Week {$tema->week})" : null;
        })->filter()->values()->toArray();
        return [
            'id_pendaftaran'      => $pendaftaran->id,
            'order_id'            => $pembayaran->order_id,
            'nama_orang_tua'      => optional($pendaftaran->customer)->nama_lengkap,
            'email'               => optional($pendaftaran->customer)->user->email,
            'nama_lengkap'        => optional($detailKid->children)->nama_lengkap,
            'nama_panggilan'      => optional($detailKid->children)->panggilan,
            'tgl_lahir'           => optional($detailKid->children)->tgl_lahir,
            'kelas'               => optional(optional($detailKid->jadwalKid)?->kategori?->kid)->nama,
            'kategori'            => optional($detailKid->jadwalKid?->kategori)->nama,
            'judul_tema'          => $detailKid->detailPendaftaranTema->first()->tema->tema->nama,
            'tema'                => $temaList,
            'no_telepon'          => optional($pendaftaran->customer)->notelp,
            'status_pembayaran'   => $pembayaran->status ?? 'Pending',
            'status_pendaftaran'  => $pendaftaran->status ?? 'Pending',
            'snap_url'            => $pembayaran->snap_url,
            'harga_awal'          => $pendaftaran->nominal,
            'diskon'              => $pendaftaran->diskon,
            'total_pembayaran'    => $pembayaran->amount
        ];
    }

    public static function getDataPembayaranArtSpace(String $order_id)
    {
        $pembayaran = PembayaranBooking::with(['pendaftaran.customer.user', 'pendaftaran.detailPendaftaran.kegiatans', 'pendaftaran.sesis'])->where('order_id', $order_id)->firstOrFail();
        $pendaftaran = $pembayaran->pendaftaran;
        $detailPendaftaran = optional($pendaftaran)->detailPendaftaran;
        $kegiatans = $detailPendaftaran?->map(function ($kegiatan) {
            return ['nama'  => $kegiatan->nama_peserta, 'kegiatan' => $kegiatan->kegiatans->nama, 'harga' => $kegiatan->kegiatans->harga];
        })->values()->toArray();

        return [
            'id_pendaftaran'        => $pendaftaran->id,
            'order_id'              => $pembayaran->order_id,
            'nama'                  => optional($pendaftaran->customer)->nama_lengkap,
            'email'                 => optional($pendaftaran->customer)->user->email,
            'no_telepon'            => optional($pendaftaran->customer)->notelp,
            'tanggal_reservasi'     => $pendaftaran->tanggal_reservasi,
            'sesi'                  => optional($pendaftaran->sesis),
            'kegiatans'             => $kegiatans,
            'status_pembayaran'     => $pembayaran->status ?? 'Pending',
            'status_pendaftaran'    => $pendaftaran->status ?? 'Pending',
            'snap_url'              => $pembayaran->snap_url,
            'harga_awal'            => $pendaftaran->nominal,
            'diskon'                => $pendaftaran->diskon,
            'total_pembayaran'      => $pembayaran->amount
        ];
    }
}
