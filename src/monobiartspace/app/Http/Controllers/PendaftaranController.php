<?php

namespace App\Http\Controllers;

use App\Mail\CancelPendataranArtspace;
use App\Mail\CancelPendataranKids;
use App\Models\Pendaftaran;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class PendaftaranController extends Controller
{
    protected $pembayaranService;

    public function __construct(PembayaranService $pembayaranService)
    {
        $this->pembayaranService = $pembayaranService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $pendaftaran = Pendaftaran::select('pendaftarans.*', 'customers.nama_lengkap as nama_customer', 'customers.notelp', 'users.email', DB::raw('CONCAT(jadwal_art_spaces.sesi, " ", jadwal_art_spaces.mulai, "-", jadwal_art_spaces.akhir) as jadwal'))
                ->leftJoin('customers', 'customers.id', '=', 'pendaftarans.customer_id')
                ->leftJoin('users', 'users.id', '=', 'customers.user_id')
                ->leftJoin('jadwal_art_spaces', 'jadwal_art_spaces.id', '=', 'pendaftarans.sesi')
                ->latest();
            return DataTables::of($pendaftaran)->addColumn('tanggal_reservasi', function ($row) {
                return $row->tanggal_reservasi != null ? \Carbon\Carbon::parse($row->tanggal_reservasi)->translatedFormat('j F Y') : '-';
            })->filterColumn('pendaftarans.tanggal_reservasi', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_reservasi, '%j %M %Y') LIKE ?", ["%{$keyword}%"]);
            })->make();
        }
        return view('backend.pendaftaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['pembayaran']);
        if ($pendaftaran->type == 'kids') {
            $data = (object) $this->pembayaranService->getDataPembayaranKids($pendaftaran->pembayaran->order_id);
            return view('backend.pendaftaran.kid', compact('data'));
        } else {
            $data = (object) $this->pembayaranService->getDataPembayaranArtSpace($pendaftaran->pembayaran->order_id);
            return view('backend.pendaftaran.artspace', compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        if ($request->status == 'batal') {
            $pendaftaran->load('pembayaran');
            if ($pendaftaran->type == 'artspace') {
                $data = $this->pembayaranService->getDataPembayaranArtSpace($pendaftaran->pembayaran->order_id);
                Mail::to($data['email'])->send(new CancelPendataranArtspace($data));
            } else {
                $data = $this->pembayaranService->getDataPembayaranKids($pendaftaran->pembayaran->order_id);
                Mail::to($data['email'])->send(new CancelPendataranKids($data));
            }
        }
        $pendaftaran->update(['status' => $request->status]);
        return response()->json(['success' => true, 'message' => 'Status Pendaftaran Berhasil Diubah']);
    }

    public function monobiKidMessage($data)
    {
        $namaPanggilan = $data['nama_panggilan'];
        $namaOrtu = $data['nama_orang_tua'];
        $kelas = $data['kelas'];
        $kategori = $data['kategori'];
        $judulTema = $data['judul_tema'];
        $tema = $data['tema'];
        $hari = $data['jadwal']->hari;
        $jamMulai = date('H:i', strtotime($data['jadwal']->mulai));
        $jamSelesai = date('H:i', strtotime($data['jadwal']->akhir));

        $subTema = '';
        foreach ($tema as $t) {
            $subTema .= "• {$t}\n";
        }

        $pesan = <<<TEXT
Hai Ayah/Bunda {$namaOrtu}! 👋

Kami dari *Monobi Kids* mau ingetin kalau si kecil {$namaPanggilan} sudah terdaftar di kelas seru kami 🤗

✨ *Info Kelas:*
• Kelas: {$kelas}
• Kategori: {$kategori}
• Tema Utama: {$judulTema}
• Subtema:
{$subTema}
🗓️ *Jadwal Belajar:*
Hari: {$hari}
Waktu: {$jamMulai} - {$jamSelesai}

Jangan lupa ya, datang tepat waktu biar si kecil bisa belajar sambil bermain dengan maksimal 🎨👦👧

Kalau ada pertanyaan, langsung hubungi kami aja ya.
Sampai jumpa di kelas! 😊

Salam hangat,
*Tim Monobi Kids* 🎈
TEXT;
        return urlencode($pesan);
    }

    public function monobiArtSpaceMessage($data)
    {
        $nama = $data['nama'];
        $tanggal = \Carbon\Carbon::parse($data['tanggal_reservasi'])->translatedFormat('l, j F Y');
        $sesi = $data['sesi']->sesi;
        $mulai = date('H:i', strtotime($data['sesi']->mulai));
        $akhir = date('H:i', strtotime($data['sesi']->akhir));
        $kegiatanList = collect($data['kegiatans'])->map(function ($kegiatan) {
            return "• {$kegiatan['nama']} ({$kegiatan['kegiatan']})";
        })->implode("\n");

        $pesan = <<<TEXT
Hai $nama! 👋

Terima kasih telah mendaftar di *Monobi ArtSpace*. Kami ingin mengingatkan bahwa kamu memiliki jadwal kegiatan berikut:

📅 *Tanggal:* $tanggal  
🕒 *Sesi:* $sesi ($mulai - $akhir)  
🎨 *Kegiatan:*
$kegiatanList

Mohon hadir tepat waktu agar sesi berjalan lancar dan menyenangkan 😊  
Jika ada pertanyaan atau perubahan, silakan hubungi admin kami.

Sampai jumpa di Monobi! 🎭
TEXT;
        return urlencode($pesan);
    }

    public function getMessage(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load('pembayaran');
        if ($pendaftaran->type == 'artspace') {
            $data = $this->pembayaranService->getDataPembayaranArtSpace($pendaftaran->pembayaran->order_id);
            $message = $this->monobiArtSpaceMessage($data);
        } else {
            $data = $this->pembayaranService->getDataPembayaranKids($pendaftaran->pembayaran->order_id);
            $message = $this->monobiKidMessage($data);
        }

        return response()->json(['succes' => true, 'data' => ['message' => $message, 'phone' => $data['no_telepon']]]);
    }
}
