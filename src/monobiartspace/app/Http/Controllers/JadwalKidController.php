<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalKidStoreRequest;
use App\Http\Requests\JadwalKidUpdateRequest;
use App\Models\JadwalKid;
use App\Models\KategoriKid;
use App\Models\Kid;
use Yajra\DataTables\Facades\DataTables;

class JadwalKidController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $hariOptions = [
        'senin' => 'Senin',
        'selasa' => 'Selasa',
        'rabu' => 'Rabu',
        'kamis' => 'Kamis',
        'jumat' => 'Jumat',
        'sabtu' => 'Sabtu',
        'minggu' => 'Minggu',
    ];

    public function index()
    {
        if (request()->ajax()) {
            $jadwal = JadwalKid::with('kategori');
            return DataTables::of($jadwal)->addColumn('hari', function ($row) {
                return ucfirst($row->hari);
            })->filterColumn('hari', function ($query, $keyword) {
                $query->whereRaw("hari LIKE ?", ["%{$keyword}%"]);
            })->addColumn('mulai', function ($row) {
                return \Carbon\Carbon::parse($row->mulai)->translatedFormat('H:i');
            })->filterColumn('mulai', function ($query, $keyword) {
                $query->whereRaw("TIME_FORMAT(mulai, '%H:%i') LIKE ?", ["%{$keyword}%"]);
            })->addColumn('akhir', function ($row) {
                return \Carbon\Carbon::parse($row->akhir)->translatedFormat('H:i');
            })->filterColumn('akhir', function ($query, $keyword) {
                $query->whereRaw("TIME_FORMAT(akhir, '%H:%i') LIKE ?", ["%{$keyword}%"]);
            })->make();
        }
        return view('backend.kids.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategories = KategoriKid::all();
        $days = $this->hariOptions;
        return view('backend.kids.jadwal.create', compact('kategories', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalKidStoreRequest $request)
    {
        $data = $request->validated();

        JadwalKid::create($data);

        return redirect()->route('kids-jadwal.index')->with('success', 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKid $jadwalKid)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKid $jadwalKid)
    {
        $kategories = KategoriKid::all();
        $days = $this->hariOptions;
        return view('backend.kids.jadwal.edit', compact('jadwalKid', 'kategories', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalKidUpdateRequest $request, JadwalKid $jadwalKid)
    {
        $data = $request->validated();

        $jadwalKid->update($data);

        return redirect()->route('kids-jadwal.index')->with('success', 'Jadwal Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKid $jadwalKid)
    {
        $jadwalKid->delete();
        return response()->json([
            'success' => true,
            'message' => 'Jadwal Berhasil Dihapus',
        ]);
    }

    public function getData(String $id)
    {
        $data = JadwalKid::where('kategori_id', $id)->get();
        return response()->json($data);
    }
}
