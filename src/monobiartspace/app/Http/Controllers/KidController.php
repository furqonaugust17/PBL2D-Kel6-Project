<?php

namespace App\Http\Controllers;

use App\Http\Requests\KidStoreRequest;
use App\Http\Requests\KidUpdateRequest;
use App\Models\Kid;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $kids = Kid::query();
            return DataTables::of($kids)->make();
        }
        return view('backend.kids.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kids.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KidStoreRequest $request)
    {
        $data = $request->validated();

        Kid::create($data);

        return redirect()->route('kids.index')->with('success', 'Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kid $kid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kid $kid)
    {
        return view('backend.kids.kelas.edit', compact('kid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KidUpdateRequest $request, Kid $kid)
    {
        $data = $request->validated();

        $kid->update($data);
        return redirect()->route('kids.index')->with('success', 'Kelas Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kid $kid)
    {
        $kid->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kelas Berhasil Dihapus',
        ]);
    }
}
