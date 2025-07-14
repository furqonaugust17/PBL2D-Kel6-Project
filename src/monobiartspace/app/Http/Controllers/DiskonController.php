<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiskonStoreRequest;
use App\Http\Requests\DiskonUpdateRequest;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $diskon = Diskon::query();
            return DataTables::of($diskon)->make();
        }

        return view('backend.diskon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.diskon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiskonStoreRequest $request)
    {

        $data = $request->validated();

        Diskon::create($data);


        return redirect()->route('diskon.index')->with('success', 'Data diskon Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diskon $diskon)
    {
        return view('backend.diskon.edit', compact('diskon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiskonUpdateRequest $request, Diskon $diskon)
    {
        $data = $request->validated();

        $diskon->update($data);

        return redirect()->route('diskon.index')->with('success', 'Data Diskon Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diskon $diskon)
    {
        $diskon->delete();
        return response()->json([
            'success' => true,
            'message' => 'Diskon Berhasil Dihapus',
        ]);
    }

    public function getDiskon(Request $request)
    {
        $diskon = Diskon::where('code', $request->diskon)->first();
        if (!$diskon) {
            return response()->json(['success' => false, 'message' => 'Kode Diskon Tidak Ada'])->setStatusCode(404);
        }

        if (now()->diffInDays("$diskon->expired_date 23:59:59") < 0) {
            return response()->json(['success' => false, 'message' => 'Kode Diskon Sudah Tidak Berlaku']);
        }

        return response()->json(['success' => true, 'data' => $diskon, 'message' => 'anda mendapatkan diskon sebesar ' . $diskon->diskon . '%']);
    }
}
