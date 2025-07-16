<?php

namespace App\Http\Controllers;

use App\Http\Requests\HargaClassKidStoreRequest;
use App\Http\Requests\HargaClassKidUpdateRequest;
use App\Models\HargaClassKid;
use App\Models\Kid;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HargaClassKidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $harga = HargaClassKid::with('kid');
            return DataTables::of($harga)->make();
        }
        return view('backend.kids.harga.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kids = Kid::all();
        return view('backend.kids.harga.create', compact('kids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HargaClassKidStoreRequest $request)
    {
        $data = $request->validated();

        HargaClassKid::create($data);

        return redirect()->route('kids-price.index')->with('success', 'Harga Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HargaClassKid $kidsPrice)
    {
        $kids = Kid::all();
        return view('backend.kids.harga.edit', compact('kidsPrice', 'kids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HargaClassKidUpdateRequest $request, HargaClassKid $kidsPrice)
    {
        $data = $request->validated();

        $kidsPrice->update($data);

        return redirect()->route('kids-price.index')->with('success', 'Harga Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HargaClassKid $kidsPrice)
    {
        $kidsPrice->delete();
        return response()->json([
            'success' => true,
            'message' => 'Harga Berhasil Dihapus',
        ]);
    }
}
