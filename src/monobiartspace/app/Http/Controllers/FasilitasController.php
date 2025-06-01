<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FasilitasController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $fasilitas = Fasilitas::with('ruang')->select('fasilitas.*');
            return DataTables::of($fasilitas)
                ->addColumn('nama_ruang', function ($row) {
                    return $row->ruang->nama ?? '-';
                })
                ->make();
        }

        return view('backend.fasilitas.index');
    }

    public function create()
    {
        $ruangs = \App\Models\Ruang::all(); // untuk dropdown pilihan ruang
        return view('backend.fasilitas.create', compact('ruangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruang' => 'required|exists:ruang,id',
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        Fasilitas::create([
            'id_ruang' => $request->id_ruang,
            'nama_fasilitas' => $request->nama_fasilitas,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Data Fasilitas Berhasil Disimpan');
    }

    public function edit(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $ruangs = \App\Models\Ruang::all();
        return view('backend.fasilitas.edit', compact('fasilitas', 'ruangs'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_ruang' => 'required|exists:ruang,id',
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update([
            'id_ruang' => $request->id_ruang,
            'nama_fasilitas' => $request->nama_fasilitas,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Data Fasilitas Berhasil Diperbarui');
    }

    public function destroy(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return response()->json(['success' => true, 'message' => 'Data Fasilitas Berhasil Dihapus']);
    }
}
