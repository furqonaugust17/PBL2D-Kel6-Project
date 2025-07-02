<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerStoreRequest;
use App\Http\Requests\PartnerUpdateRequest;
use App\Models\Partner;
use App\Notifications\PartnerNotification;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PartnerController extends Controller
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
            $partner = Partner::query();
            return DataTables::of($partner)->make();
        }

        return view('backend.partner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerStoreRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->imageUploadService->storeSingle($request->file('image'), 'partner');
        $partner = Partner::create($data);

        $title = 'Partner Baru Terdaftar';
        $message = 'Selamat! Anda telah berhasil terdaftar sebagai partner di ' . config('app.name') . '.';
        $partner->notify(new PartnerNotification(message: $message, title: $title));

        return redirect()->route('partner.index')->with('success', 'Partner Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('backend.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerUpdateRequest $request, Partner $partner)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->imageUploadService->deleteSingleImage($partner->image);
            $data['image'] = $this->imageUploadService->storeSingle($request->file('image'), 'partner');
        }

        $partner->update($data);

        $message = 'Informasi akun Anda pada sistem Monobi telah berhasil diperbarui.';
        $title = 'Perubahan Data Partner';
        $partner->notify(new PartnerNotification(message: $message, title: $title));
        return redirect()->route('partner.index')->with('success', 'Partner Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $this->imageUploadService->deleteSingleImage($partner->image);
        $partner->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Partner Berhasil Dihapus',
        ]);
    }
}
