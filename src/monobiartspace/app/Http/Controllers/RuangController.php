<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangStoreRequest;
use App\Http\Requests\RuangUpdateRequest;
use App\Models\Ruang;
use Yajra\DataTables\Facades\DataTables;


class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $ruang = Ruang::query();
            return DataTables::of($ruang)->make();
        }

        return view('backend.ruang.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ruang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RuangStoreRequest $request)
    {
        $data = $request->validated();

        Ruang::create($data);

        return redirect()->route('ruang.index')->with('success', 'Data Ruang Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruang $ruang)
    {
        return view('backend.ruang.edit', compact('ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RuangUpdateRequest $request, Ruang $ruang)
    {
        $data = $request->validated();

        $ruang->update($data);

        return redirect()->route('ruang.index')->with('success', 'Data Ruang Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
    {
        $ruang->delete();

        return response()->json(['success' => true, 'message' => 'Data Ruang Berhasil Dihapus']);
    }
}
