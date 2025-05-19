<?php

namespace App\Http\Controllers;

use App\Models\DetailPendaftaran;
use App\Models\JadwalArtSpace;
use App\Models\KegiatanArtSpace;
use App\Models\Kid;
use App\Models\PembayaranBooking;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        // dd($request);
        // $kegiatanArtSpace = KegiatanArtSpace::all();
        // $jadwalArtSpace = JadwalArtSpace::all();
        // return view('frontend.booking.artspace', compact('kegiatanArtSpace', 'jadwalArtSpace'));
        // dd(Auth::user()->customer->id);
        DB::beginTransaction();
        try {
            $session = JadwalArtSpace::findOrFail($request->sesi);

            // Hitung total peserta yang sudah booking untuk sesi tersebut
            $currentParticipantCount = Pendaftaran::where('schedule_id', $request->sesi)->where('tanggal_reservasi', $request->tanggal)->withCount('detailPendaftaran')->get()->sum(function ($booking) {
                return $booking->detailPendaftaran->count();
            });

            // dd($currentParticipantCount);
            $maxCapacity = 10;
            $incoming = count($request->participants);

            if ($currentParticipantCount + $incoming > $maxCapacity) {
                return response()->json(['message' => 'Sesi sudah penuh!'], 422);
            }


            $booking = Pendaftaran::create([
                'type'  => 'artspace',
                'customer_id'   => Auth::user()->customer->id,
                'schedule_id' => $request->sesi,
                'tanggal_reservasi' => $request->tanggal
            ]);




            // Redirect atau return Midtrans Snap Token
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = 'SB-Mid-server-Quz-xm_5OB9vKo4oRAGr5TM7';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $kegiatans = KegiatanArtSpace::all()->keyBy('id');
            $participants = collect($request->participants);
            $detailItem = $participants->groupBy('activity_id')->map(function ($group, $activity_id) use ($kegiatans) {
                $kegiatan = $kegiatans[$activity_id] ?? null;
                return [
                    'id' => 'activity_' . $activity_id,
                    'name' => $kegiatan->nama ?? 'Unknown',
                    'quantity' => intval($group->count()),
                    'price' => intval($kegiatan->harga ?? 0)
                ];
            })->values()->toArray();

            // dd($detailItem);
            $total_price = collect($detailItem)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });



            foreach ($request->participants as $participant) {
                DetailPendaftaran::create([
                    'pendaftaran_id' => $booking->id,
                    'nama_peserta' => $participant['name'],
                    'kegiatan' => $participant['activity_id']
                ]);
            }

            $booking->update(['total_price' => $total_price]);

            $order_id = 'booking-artspace-' . Auth::user()->customer->id .  '-' . now()->format('YmdHis') . '-' . Str::random(4);
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => $total_price,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->customer->nama_lengkap,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->customer->notelp,
                ),
                'item_details' => $detailItem
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            PembayaranBooking::create([
                'order_id'  => $order_id,
                'pendaftaran_id'    => $booking->id,
                'amount'    => $total_price,
                'snap_token'    => $snapToken
            ]);

            DB::commit();


            return response()->json([
                'message' => 'Booking berhasil dibuat.',
                'snapToken' => $snapToken
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Gagal membuat booking: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function kids()
    {
        $kids = Kid::all();
        return view('frontend.booking.kid', compact('kids'));
    }
}
