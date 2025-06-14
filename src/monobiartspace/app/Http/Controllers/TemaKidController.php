<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemaKidStoreRequest;
use App\Http\Requests\TemaKidUpdateRequest;
use App\Models\DetailTemaKid;
use App\Models\Kid;
use App\Models\TemaKid;
use App\Services\ImageUploadService;
use Yajra\DataTables\Facades\DataTables;

class TemaKidController extends Controller
{
    protected $imageUploadService;
    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
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
            })->addColumn('is_active', function ($row) {
                return $row->is_active == 1 ? 'aktif' : 'tidak aktif';
            })->filterColumn('is_active', function ($query, $keyword) {
                $value = strtolower($keyword) === 'aktif' ? 1 : 0;
                $query->where('is_active', $value);
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
            'deskripsi' => $data['deskripsi'],
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
        $paths = $this->imageUploadService->uploadMany($request->file('foto'), 'uploads/tema');
        $tema->images()->createMany($paths);

        return redirect()->route('kids-tema.index')->with('success', 'Tema Berhasil Ditambahkan');
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
        $data['is_active'] = $request->has('is_active');

        $kidsTema->update([
            'nama'  => $data['nama'],
            'deskripsi' => $data['deskripsi'],
            'waktu' => date('Y-m-d', strtotime($data['waktu'])),
            'kid_id'    => $data['kid_id'],
            'is_active' => $data['is_active']
        ]);

        foreach ($kidsTema->detailTema as $index => $detailTema) {
            $detailTema->nama = $data['week'][$index];
            $detailTema->save();
        }
      
        if ($request->hasFile('foto')) {
            $this->imageUploadService->deleteImages($kidsTema->images);

            $paths = $this->imageUploadService->uploadMany($request->file('foto'), 'uploads/tema');

            $kidsTema->images()->createMany($paths);
        }
      
        return redirect()->route('kids-tema.index')->with('success', 'Tema Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemaKid $kidsTema)
    {
        $this->imageUploadService->deleteImages($kidsTema->images);
        $kidsTema->detailTema()->delete();
        $kidsTema->delete();
        return response()->json([
            'success' => true,
            'message' => 'Tema Berhasil Dihapus',
        ]);
    }

    public function getData(String $id)
    {
        $data = TemaKid::with('detailTema')->where('kid_id', $id)->where('is_active', 1)->first();
        return response()->json(['data' => $data]);
    }
}
