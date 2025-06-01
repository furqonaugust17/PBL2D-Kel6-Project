<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Ruang::create([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('ruang.index')->with('success', 'Data Ruang Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruang = Ruang::findOrFail($id);
        return view('backend.ruang.edit', compact('ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $ruang = Ruang::findOrFail($id);
        $ruang->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('ruang.index')->with('success', 'Data Ruang Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruang = Ruang::findOrFail($id);
        $ruang->delete();

        return response()->json(['success' => true, 'message' => 'Data Ruang Berhasil Dihapus']);
    }
}
