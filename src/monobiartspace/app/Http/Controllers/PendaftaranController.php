<?php

namespace App\Http\Controllers;

use App\Mail\PendaftaranKids;
use App\Models\Children;
use App\Models\DetailPendaftaran;
use App\Models\DetailPendaftaranKid;
use App\Models\DetailPendaftaranTema;
use App\Models\DetailTemaKid;
use App\Models\JadwalArtSpace;
use App\Models\KategoriKid;
use App\Models\KegiatanArtSpace;
use App\Models\Kid;
use App\Models\PembayaranBooking;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

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

    public function storekids(Request $request)
    {
        DB::beginTransaction();
        try {
            $userData = Auth::user();
            $customerData = $userData->customer;

            $currentParticipantCount = DetailPendaftaranKid::where('jadwal_id', $request->jadwal)->get()->count();

            $maxCapacity = 10;

            if ($currentParticipantCount > $maxCapacity) {
                return response()->json(['message' => 'Sesi sudah penuh!'], 400);
            }

            $calculate = $this->calculateTransaction($request)->getData();
            $children = Children::where('nama_lengkap', $request->nama_lengkap)->where('tgl_lahir', $request->tanggal_lahir)->where('parent_id', $customerData->id)->first();
            if (!$children) {
                $children = Children::create([
                    'parent_id' => $customerData->id,
                    'nama_lengkap'  => $request->nama_lengkap,
                    'panggilan'  => $request->nama_panggilan,
                    'tgl_lahir' => $request->tanggal_lahir,
                ]);
            }

            $total_price = $calculate->total_bayar;
            $hargaAwal = $calculate->harga;
            $diskon = $calculate->diskon;

            $booking = Pendaftaran::create([
                'type'  => 'kids',
                'customer_id'   => $customerData->id,
                'total_price'   => $total_price
            ]);

            $detailBooking = DetailPendaftaranKid::create([
                'pendaftaran_id'    => $booking->id,
                'children_id'   => $children->id,
                'jadwal_id' => $request->jadwal,
            ]);

            foreach ($request->tema as $index => $tema) {
                DetailPendaftaranTema::create([
                    'detail_pendaftaran_id' => $detailBooking->id,
                    'tema_id'   => $tema,
                ]);
            }

            $temaModel = DetailTemaKid::all()->keyBy('id');
            $temas = collect($request->tema);
            $detailItem = $temas->map(function ($tema_id) use ($temaModel) {
                $tema = $temaModel[$tema_id] ?? null;
                return [
                    'id' => 'tema_' . $tema_id,
                    'name' => $tema->nama ?? 'Unknown',
                    'quantity' => 1,
                    'price' => 80000
                ];
            })->values()->toArray();

            array_push($detailItem, [
                'id' => 'D01',
                'name' => 'Diskon',
                'quantity' => 1,
                'price' => -$diskon
            ]);

            $order_id = 'booking-kids-' . $customerData->id .  '-' . now()->format('YmdHis') . '-' . Str::random(4);
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => $total_price,
                ),
                'customer_details' => array(
                    'first_name' => $customerData->nama_lengkap,
                    'email' => $userData->email,
                    'phone' => $customerData->notelp,
                ),
                'item_details'  => $detailItem
            );

            $payment = \Midtrans\Snap::createTransaction($params);

            PembayaranBooking::create([
                'order_id'  => $order_id,
                'pendaftaran_id'    => $booking->id,
                'amount'    => $total_price,
                'snap_token'    => $payment->token,
                'snap_url'      => $payment->redirect_url
            ]);

            DB::commit();
            $mailData = [
                'nama_orang_tua' => $customerData->nama_lengkap,
                'nama_lengkap' => $children->nama_lengkap,
                'nama_panggilan'    => $children->panggilan,
                'kelas' => Kid::find($request->kelas)->nama,
                'kategori'  => KategoriKid::find($request->kategori)->nama,
                'tema'  => $temas->map(function ($tema_id) use ($temaModel) {
                    $tema = $temaModel[$tema_id] ?? null;
                    return $tema->nama . " (Week " . $tema['week'] . " )" ?? 'Unknown';
                })->values()->toArray(),
                'no_telepon'   => $customerData->notelp,
                'status_pembayaran' => 'Pending',
                'snap_url'  => $payment->redirect_url,
                'harga_awal' => $hargaAwal,
                'diskon' => $diskon,
                'total_pembayaran' => $total_price
            ];

            Mail::to($userData->email)->send(new PendaftaranKids($mailData));
            return response()->json([
                'message' => 'Booking berhasil dibuat.',
                'snapToken' => $payment->token
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Gagal membuat booking: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function calculateTransaction(Request $request)
    {
        $hargaSatuan = 80000;
        $diskon = 0;
        $jumlahTema = count($request->tema);
        if ($jumlahTema == 3) {
            $diskon = 10000;
        } elseif ($jumlahTema == 4) {
            $diskon = 20000;
        }
        $temaModel = DetailTemaKid::all()->keyBy('id');
        $temas = collect($request->tema);
        $detailTema = $temas->map(function ($tema_id) use ($temaModel) {
            $tema = $temaModel[$tema_id] ?? null;
            return [
                'id'    => $tema_id,
                'nama' => $tema->nama ?? 'Unknown',
            ];
        })->values()->toArray();
        return response()->json(['harga' => ($jumlahTema * $hargaSatuan), 'diskon' => $diskon, 'total_bayar' => (($jumlahTema * $hargaSatuan) - $diskon), 'tema' => $detailTema]);
    }

    public function sendMail()
    {
        $data = [
            'nama_orang_tua' => 'Furqon August Seventeenth',
            'nama_lengkap' => 'Furqon August Seventeenth',
            'nama_panggilan'    => 'Furqon',
            'kelas' => 'KiddyNest',
            'kategori'  => 'Kindergarten',
            'tema'  => [
                'Flowers in Bloom',
                "The Best Bird's Nest"
            ],
            'no_telepon'   => '+6283180231',
            'status_pembayaran' => 'Pending',
            'snap_url'  => 'https://billing.web.id'
        ];
        Mail::to('furqonaugustseventeenth@gmail.com')->send(new PendaftaranKids($data));
    }
}
