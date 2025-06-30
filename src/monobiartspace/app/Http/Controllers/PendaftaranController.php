<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
