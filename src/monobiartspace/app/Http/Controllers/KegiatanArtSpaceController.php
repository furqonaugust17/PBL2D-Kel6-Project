<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanArtSpaceStoreRequest;
use App\Http\Requests\KegiatanArtSpaceUpdateRequest;
use App\Models\ArtSpace;
use App\Models\KegiatanArtSpace;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanArtSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $kegiatanArtSpace = KegiatanArtSpace::query();
            return DataTables::of($kegiatanArtSpace)->make();
        }
        return view('backend.artspaces.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelases = ArtSpace::all();
        return view('backend.artspaces.kegiatan.create', compact('kelases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KegiatanArtSpaceStoreRequest $request)
    {
        $data = $request->validated();
        KegiatanArtSpace::create($data);
        return redirect()->route('kegiatan-artspace.index')->with('success', 'Kegiatan Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KegiatanArtSpace $kegiatanArtSpace)
    {
        $kelases = ArtSpace::all();
        return view('backend.artspaces.kegiatan.edit', ['kegiatan' => $kegiatanArtSpace, 'kelases' => $kelases]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KegiatanArtSpaceUpdateRequest $request, KegiatanArtSpace $kegiatanArtSpace)
    {
        $data = $request->validated();
        $kegiatanArtSpace->update($data);

        return redirect()->route('kegiatan-artspace.index')->with('success', 'Kegiatan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KegiatanArtSpace $kegiatanArtSpace)
    {
        $kegiatanArtSpace->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kegiatan Berhasil Dihapus',
        ]);
    }
}
