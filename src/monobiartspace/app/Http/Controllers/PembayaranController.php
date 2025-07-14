<?php

namespace App\Http\Controllers;

use App\Models\PembayaranBooking;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
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
            $pembayaran = PembayaranBooking::with(['pendaftaran', 'pendaftaran.customer'])->latest();
            return DataTables::of($pembayaran)->make();
        }
        return view('backend.pembayaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(PembayaranBooking $pembayaran, String $type)
    {
        $data = $pembayaran->load(['pendaftaran.customer.user']);
        return view('backend.pembayaran.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PembayaranBooking $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PembayaranBooking $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PembayaranBooking $pembayaran)
    {
        //
    }
}
