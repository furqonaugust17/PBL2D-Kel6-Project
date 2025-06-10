<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalArtSpaceStoreRequest;
use App\Http\Requests\JadwalArtSpaceUpdateRequest;
use App\Models\JadwalArtSpace;
use Yajra\DataTables\Facades\DataTables;

class JadwalArtSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $jadwalArtSpace = JadwalArtSpace::query();
            return DataTables::of($jadwalArtSpace)->addColumn('mulai', function ($row) {
                return \Carbon\Carbon::parse($row->mulai)->translatedFormat('H:i');
            })->filterColumn('mulai', function ($query, $keyword) {
                $query->whereRaw("TIME_FORMAT(mulai, '%H:%i') LIKE ?", ["%{$keyword}%"]);
            })->addColumn('akhir', function ($row) {
                return \Carbon\Carbon::parse($row->akhir)->translatedFormat('H:i');
            })->filterColumn('akhir', function ($query, $keyword) {
                $query->whereRaw("TIME_FORMAT(akhir, '%H:%i') LIKE ?", ["%{$keyword}%"]);
            })->make(true);
        }
        return view('backend.artspaces.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.artspaces.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalArtSpaceStoreRequest $request)
    {
        $data = $request->validated();

        JadwalArtSpace::create($data);

        return redirect()->route('artspace-jadwal.index')->with('success', 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalArtSpace $jadwalArtSpace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalArtSpace $jadwalArtSpace)
    {
        return view('backend.artspaces.jadwal.edit', compact('jadwalArtSpace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalArtSpaceUpdateRequest $request, JadwalArtSpace $jadwalArtSpace)
    {
        $data = $request->validated();
        $jadwalArtSpace->update($data);
        return redirect()->route('artspace-jadwal.index')->with('success', 'Jadwal Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalArtSpace $jadwalArtSpace)
    {
        $jadwalArtSpace->delete();
        return response()->json([
            'success' => true,
            'message' => 'Jadwal Berhasil Dihapus',
        ]);
    }
}
