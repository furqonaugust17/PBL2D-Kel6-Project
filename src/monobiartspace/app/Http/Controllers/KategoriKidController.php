<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriKidsStoreRequest;
use App\Http\Requests\KategoriKidsUpdateRequest;
use App\Models\KategoriKid;
use App\Models\Kid;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriKidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $kategori = KategoriKid::query();
            return DataTables::of($kategori)->make();
        }
        return view('backend.kids.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kids = Kid::all();
        return view('backend.kids.kategori.create', compact('kids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriKidsStoreRequest $request)
    {
        $data = $request->validated();
        KategoriKid::create($data);

        return redirect()->route('kids-kategori.index')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKid $kidsKategori)
    {
        $kids = Kid::all();
        return view('backend.kids.kategori.edit', compact('kategoriKid', 'kids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriKidsUpdateRequest $request, KategoriKid $kidsKategori)
    {
        $data = $request->validated();

        $kidsKategori->update($data);

        return redirect()->route('kids-kategori.index')->with('success', 'Kategori Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKid $kidsKategori)
    {
        $kidsKategori->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kategori Berhasil Dihapus',
        ]);
    }

    public function getData(String $id)
    {
        $data = KategoriKid::where('kid_id', $id)->get();
        return response()->json($data);
    }
}
