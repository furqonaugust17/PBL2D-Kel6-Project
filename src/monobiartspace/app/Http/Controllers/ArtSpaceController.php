<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtSpaceStoreRequest;
use App\Http\Requests\ArtSpacUpdateRequest;
use App\Models\ArtSpace;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArtSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $artSpapce = ArtSpace::query();
            return DataTables::of($artSpapce)->make();
        }
        return view('backend.artspaces.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.artspaces.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArtSpaceStoreRequest $request)
    {
        $data = $request->validated();
        ArtSpace::create($data);

        return redirect()->route('artspace.index')->with('success', 'Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArtSpace $artSpace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArtSpace $artspace)
    {
        return view('backend.artspaces.kelas.edit', ['kelas' => $artspace]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArtSpacUpdateRequest $request, ArtSpace $artspace)
    {
        $data = $request->validated();
        $artspace->update($data);
        return redirect()->route('artspace.index')->with('success', 'Kelas Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArtSpace $artspace)
    {
        $artspace->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kelas Berhasil Dihapus',
        ]);
    }
}
