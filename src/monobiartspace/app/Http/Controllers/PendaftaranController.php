<?php

namespace App\Http\Controllers;

use App\Models\DetailPendaftaran;
use App\Models\JadwalArtSpace;
use App\Models\KegiatanArtSpace;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function artSpace()
    {
        $kegiatanArtSpace = KegiatanArtSpace::all();
        $jadwalArtSpace = JadwalArtSpace::all();
        return view('frontend.booking.artspace', compact('kegiatanArtSpace', 'jadwalArtSpace'));
    }

    public function storeArtSpace(Request $request)
    {
        dump($request);
        // $kegiatanArtSpace = KegiatanArtSpace::all();
        // $jadwalArtSpace = JadwalArtSpace::all();
        // return view('frontend.booking.artspace', compact('kegiatanArtSpace', 'jadwalArtSpace'));
        DB::beginTransaction();
        try {
            $session = JadwalArtSpace::findOrFail($request->sesi);

            // Hitung total peserta yang sudah booking untuk sesi tersebut
            $currentParticipantCount = Pendaftaran::where('schedule_id', $request->sesi)->where('tanggal_reservasi', $request->tanggal)->withCount('detailPendaftaran')->get()->sum(function ($booking) {
                return $booking->detailPendaftaran->count();
            });

            // dd($currentParticipantCount);
            $maxCapacity = 3;
            $incoming = count($request->participants);

            if ($currentParticipantCount + $incoming > $maxCapacity) {
                return response()->json(['message' => 'Sesi sudah penuh!'], 422);
            }


            $booking = Pendaftaran::create([
                'type'  => 'artspace',
                'user_id'   => Auth::user()->id,
                'schedule_id' => $request->sesi,
                'tanggal_reservasi' => $request->tanggal
            ]);

            $total_price = 0;
            foreach ($request->participants as $participant) {
                $kegiatan = KegiatanArtSpace::find($participant['activity_id']);
                $total_price += $kegiatan->harga;
                DetailPendaftaran::create([
                    'pendaftaran_id' => $booking->id,
                    'nama_peserta' => $participant['name'],
                    'kegiatan' => $participant['activity_id']
                ]);
            }

            $booking->update(['total_price' => $total_price]);
            DB::commit();

            // Redirect atau return Midtrans Snap Token
            return response()->json([
                'message' => 'Booking berhasil dibuat.',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Gagal membuat booking: ' . $e->getMessage(),
            ], 500);
        }
    }
}
