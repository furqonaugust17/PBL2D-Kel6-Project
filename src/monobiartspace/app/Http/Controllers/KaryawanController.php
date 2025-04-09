<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanStoreRequest;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('backend.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KaryawanStoreRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'email_verified_at' => now()
        ]);

        $karyawan = Karyawan::create([
            'nama'  => $request->nama,
            'jk'  => $request->jk,
            'notelp'  => $request->notelp,
            'alamat'  => $request->alamat,
            'user_id'  => $user->id,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Disimpan');
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
