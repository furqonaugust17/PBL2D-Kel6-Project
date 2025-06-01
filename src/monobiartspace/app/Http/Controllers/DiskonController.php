<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:20',
            'diskon' => 'required|numeric|min:0|max:100',
            'code' => 'required|string|unique:diskons,code|max:6',
            'expired_date' => 'required|date|after:today',
        ]);

        Diskon::create([
            'nama'  => $request->nama,
            'diskon'  => $request->diskon,
            'code'  => $request->code,
            'expired_date'  => $request->expired_date,
        ]);


        return redirect()->route('diskon.index')->with('success', 'Data diskon Berhasil Disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
