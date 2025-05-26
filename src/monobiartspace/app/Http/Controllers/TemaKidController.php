<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemaKidStoreRequest;
use App\Http\Requests\TemaKidUpdateRequest;
use App\Models\DetailTemaKid;
use App\Models\Kid;
use App\Models\TemaKid;
use Yajra\DataTables\Facades\DataTables;

class TemaKidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $temas = TemaKid::query();
            return DataTables::of($temas)->addColumn('bulan_nama', function ($row) {
                return \Carbon\Carbon::parse($row->waktu)->translatedFormat('F Y');
            })->filterColumn('bulan_nama', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(waktu, '%M %Y') LIKE ?", ["%{$keyword}%"]);
            })->make(true);
        }
        return view('backend.kids.tema.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kids = Kid::all();
        return view('backend.kids.tema.create', compact('kids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TemaKidStoreRequest $request)
    {
        $data = $request->validated();

        $tema = TemaKid::create([
            'nama' => $data['nama'],
            'waktu' => date('Y-m-d', strtotime($data['waktu'])),
            'kid_id'    => $data['kid_id']
        ]);

        foreach ($data['week'] as $index => $week) {
            DetailTemaKid::create([
                'week'  => $index + 1,
                'nama'  => $week,
                'tema_kid_id' => $tema->id
            ]);
        }

        return redirect()->route('kids-tema.index')->with('success', 'Tema Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TemaKid $kidsTema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemaKid $kidsTema)
    {
        $kids = Kid::all();
        $detailTema = DetailTemaKid::where('tema_kid_id', $kidsTema->id)->get();

        return view('backend.kids.tema.edit', compact('kids', 'kidsTema', 'detailTema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TemaKidUpdateRequest $request, TemaKid $kidsTema)
    {
        $data = $request->validated();

        $kidsTema->update([
            'nama'  => $data['nama'],
            'waktu' => date('Y-m-d', strtotime($data['waktu'])),
            'kid_id'    => $data['kid_id']
        ]);

        foreach ($kidsTema->detailTema as $index => $detailTema) {
            $detailTema->nama = $data['week'][$index];
            $detailTema->save();
        }

        return redirect()->route('kids-tema.index')->with('success', 'Tema Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemaKid $kidsTema)
    {
        $kidsTema->detailTema()->delete();
        $kidsTema->delete();
        return response()->json([
            'success' => true,
            'message' => 'Tema Berhasil Dihapus',
        ]);
    }

    public function getData(String $id)
    {
        $data = TemaKid::with('detailTema')->where('kid_id', $id)->get();
        return response()->json($data);
    }
}
