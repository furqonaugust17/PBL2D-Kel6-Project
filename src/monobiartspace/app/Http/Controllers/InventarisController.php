<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventarisController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $inventaris = Inventaris::query();
            return DataTables::of($inventaris)->make();
        }


        return view('backend.inventaris.index');
    }

    public function create()
    {
        return view('backend.inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah_stok_awal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Inventaris::create($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventaris)
    {
        return view('backend.inventaris.edit', compact('inventaris'));
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah_stok_awal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $inventaris->update($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $inventaris = Inventaris::find($id);

        $inventaris->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Inventaris Berhasil Dihapus',
        ]);
    }

}
