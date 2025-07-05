<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtSpaceBookingRequest;
use App\Http\Requests\KidsBookingRequest;
use App\Mail\PendaftaranArtSpace;
use App\Mail\PendaftaranKids;
use App\Mail\PendaftaranRefundNotification;
use App\Models\Children;
use App\Models\DetailPendaftaran;
use App\Models\DetailPendaftaranKid;
use App\Models\DetailPendaftaranTema;
use App\Models\DetailTemaKid;
use App\Models\Diskon;
use App\Models\JadwalArtSpace;
use App\Models\JadwalKid;
use App\Models\KegiatanArtSpace;
use App\Models\Kid;
use App\Models\PembayaranBooking;
use App\Models\Pendaftaran;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function index()
    {
        if (request()->ajax()) {
            $pendaftaran = Pendaftaran::select('pendaftarans.*', 'pembayaran_bookings.amount',  'pembayaran_bookings.order_id')
                ->leftJoin('pembayaran_bookings', 'pembayaran_bookings.pendaftaran_id', '=', 'pendaftarans.id')
                ->where('customer_id', Auth::user()->customer->id);
            return DataTables::of($pendaftaran)->addColumn('amount', function ($row) {
                return "Rp " . number_format($row->amount, 0, ',', '.');
            })->addColumn('tanggal_reservasi', function ($row) {
                return $row->tanggal_reservasi != null ? \Carbon\Carbon::parse($row->tanggal_reservasi)->translatedFormat('j F Y') : '-';
            })->filterColumn('amount', function ($query, $keyword) {
                $query->whereRaw("amount LIKE ?", ["%{$keyword}%"]);
            })->filterColumn('tanggal_reservasi', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_reservasi, '%j %M %Y') LIKE ?", ["%{$keyword}%"]);
            })->make();
        }

        return view('frontend.booking.index');
    }

    public function show(String $id)
    {
        $pendaftaran = Pendaftaran::with(['pembayaran'])->find($id);
        if ($pendaftaran->type == 'artspace') {
            $data = (object) PembayaranService::getDataPembayaranArtSpace($pendaftaran->pembayaran->order_id);
            return view('frontend.booking.detailartspace', compact('data'));
        } else {
            $data = (object) PembayaranService::getDataPembayaranKids($pendaftaran->pembayaran->order_id);
            return view('frontend.booking.detailkids', compact('data'));
        }
    }

    public function cancel(String $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => 'ajukan batal']);
        $data = $pendaftaran->load(['pembayaran', 'customer']);
        Mail::to(env('MAIL_USERNAME'))->send(new PendaftaranRefundNotification($data));
        return response()->json(['success' => true, 'message' => 'Pembatalan Diajukan']);
    }

    public function artSpace()
    {
        $kegiatanArtSpace = KegiatanArtSpace::all();
        $jadwalArtSpace = JadwalArtSpace::all();
        return view('frontend.booking.artspace', compact('kegiatanArtSpace', 'jadwalArtSpace'));
    }

    public function storeArtSpace(ArtSpaceBookingRequest $request)
    {
        DB::beginTransaction();
        try {
            $userData = Auth::user();
            $customerData = $userData->customer;

            $currentParticipantCount = Pendaftaran::where('sesi', $request->sesi)->where('tanggal_reservasi', $request->tanggal)->withCount('detailPendaftaran')->get()->sum(function ($booking) {
                return $booking->detailPendaftaran->count();
            });

            $maxCapacity = JadwalArtSpace::find($request->sesi)->kapasitas;
            $incoming = count($request->participants);

            if ($currentParticipantCount + $incoming > $maxCapacity) {
                return response()->json(['message' => 'Sesi sudah penuh!'], 422);
            }

            $calculate = $this->calculateArtSpaceTransaction($request)->getData(true);
            $detailItem = $calculate['data'];
            $total_price = $calculate['total_bayar'];
            if ($request->diskon) {
                $diskonData = Diskon::where('code', $request->diskon)->first();
                if (now()->diffInDays("$diskonData->expired_date 23:59:59") < 0) {
                    $diskon = 0;
                } else {
                    $diskon = $total_price * ($diskonData->diskon / 100);
                    array_push($detailItem, [
                        'id' => 'D01',
                        'name' => $diskonData->nama . ' ' . $diskonData->diskon . '%',
                        'quantity' => 1,
                        'price' => -$diskon
                    ]);
                }
            } else {
                $diskon = 0;
            }

            $booking = Pendaftaran::create([
                'type'  => 'artspace',
                'customer_id'   => $customerData->id,
                'sesi' => $request->sesi,
                'tanggal_reservasi' => $request->tanggal,
                'nominal'   => $total_price,
                'diskon'    => $diskon
            ]);

            foreach ($request->participants as $participant) {
                DetailPendaftaran::create([
                    'pendaftaran_id' => $booking->id,
                    'nama_peserta' => $participant['name'],
                    'kegiatan' => $participant['activity_id']
                ]);
            }

            $order_id = 'booking-artspace-' . $customerData->id .  '-' . now()->format('YmdHis') . '-' . Str::random(4);
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
                'item_details' => $detailItem
            );
            $payment = \Midtrans\Snap::createTransaction($params);

            PembayaranBooking::create([
                'order_id'  => $order_id,
                'pendaftaran_id'    => $booking->id,
                'amount'    => $total_price - $diskon,
                'snap_token'    => $payment->token,
                'snap_url'  => $payment->redirect_url
            ]);

            DB::commit();

            $mailData = PembayaranService::getDataPembayaranArtSpace($order_id);

            Mail::to($userData->email)->send(new PendaftaranArtSpace($mailData));

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

    public function calculateArtSpaceTransaction(Request $request)
    {
        $kegiatans = KegiatanArtSpace::all()->keyBy('id');
        $participants = collect($request->participants);
        $total_bayar = 0;
        $detailItem = $participants->groupBy('activity_id')->map(function ($group, $activity_id) use ($kegiatans, &$total_bayar) {
            $kegiatan = $kegiatans[$activity_id] ?? null;
            $total_bayar += ($kegiatan->harga * intval($group->count()));
            return [
                'id' => 'activity_' . $activity_id,
                'name' => $kegiatan->nama ?? 'Unknown',
                'quantity' => intval($group->count()),
                'price' => intval($kegiatan->harga ?? 0)
            ];
        })->values()->toArray();
        return response()->json(['data' => $detailItem, 'total_bayar' => $total_bayar]);
    }

    public function kids()
    {
        $kids = Kid::all();
        return view('frontend.booking.kid', compact('kids'));
    }

    public function storekids(KidsBookingRequest $request)
    {
        DB::beginTransaction();
        try {
            $userData = Auth::user();
            $customerData = $userData->customer;

            $currentParticipantCount = DetailPendaftaranKid::where('jadwal_id', $request->jadwal)->get()->count();

            $maxCapacity = JadwalKid::find($request->jadwal)->kapasitas;


            if ($currentParticipantCount >= $maxCapacity) {
                return response()->json(['message' => 'Sesi sudah penuh!'], 400);
            }

            $calculate = $this->calculateKidTransaction($request)->getData(true);
            $children = Children::where('nama_lengkap', $request->nama_lengkap)->where('tgl_lahir', $request->tanggal_lahir)->where('parent_id', $customerData->id)->first();
            if (!$children) {
                $children = Children::create([
                    'parent_id' => $customerData->id,
                    'nama_lengkap'  => $request->nama_lengkap,
                    'panggilan'  => $request->nama_panggilan,
                    'tgl_lahir' => $request->tanggal_lahir,
                ]);
            }

            $total_price = $calculate['total_bayar'];
            $hargaAwal = $calculate['harga'];
            $diskon = $calculate['diskon'];
            $detailItem = $calculate['tema'];

            $booking = Pendaftaran::create([
                'type'  => 'kids',
                'customer_id'   => $customerData->id,
                'nominal'   => $hargaAwal,
                'diskon'    => $diskon
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

            $mailData = PembayaranService::getDataPembayaranKids($order_id);

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

    public function calculateKidTransaction(Request $request)
    {
        $jumlahTema = count($request->tema);
        $hargaData = Kid::find($request->kelas)->harga;
        $hargaSatuan = $hargaData->where('jumlah_pertemuan', 1)->first()->harga;
        $hargaJumlah = $hargaData->where('jumlah_pertemuan', $jumlahTema)->first();

        if (!$hargaJumlah) {
            $hargaJumlah = $hargaSatuan * $jumlahTema;
        } else {
            $hargaJumlah = $hargaJumlah->harga;
        }

        $diskon = ($hargaSatuan * $jumlahTema) - $hargaJumlah;

        $temaModel = DetailTemaKid::all()->keyBy('id');
        $temas = collect($request->tema);
        $detailTema = $temas->map(function ($tema_id) use ($temaModel, $hargaSatuan) {
            $tema = $temaModel[$tema_id] ?? null;
            return [
                'id'    => $tema_id,
                'name' => $tema->nama ?? 'Unknown',
                'quantity' => 1,
                'price' => $hargaSatuan
            ];
        })->values()->toArray();
        return response()->json(['harga' => ($jumlahTema * $hargaSatuan), 'diskon' => $diskon, 'total_bayar' => $hargaJumlah, 'tema' => $detailTema]);
    }
}
