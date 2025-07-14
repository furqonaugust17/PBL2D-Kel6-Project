<?php

namespace App\Http\Controllers;

use App\Http\Requests\GaleriStoreRequest;
use App\Http\Requests\GaleriUpdateRequest;
use App\Models\Galeri;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
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
            $galeri = Galeri::query();
            return DataTables::of($galeri)->make();
        }

        return view('backend.galeri.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GaleriStoreRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->imageUploadService->storeSingle($request->file('image'));
        Galeri::create($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('backend.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GaleriUpdateRequest $request, Galeri $galeri)
    {
        $data = $request->validated();

        $this->imageUploadService->deleteSingleImage($galeri->image);
        $data['image'] = $this->imageUploadService->storeSingle($request->file('image'));

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $this->imageUploadService->deleteSingleImage($galeri->image);
        $galeri->delete();
        return response()->json([
            'success' => true,
            'message' => 'Galeri Berhasil Dihapus',
        ]);
    }
}
