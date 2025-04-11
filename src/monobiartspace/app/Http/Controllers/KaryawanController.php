<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanStoreRequest;
use App\Http\Requests\KaryawanUpdateRequest;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $karyawan = Karyawan::query();
            return DataTables::of($karyawan)->make();
        }

        return view('backend.karyawan.index');
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
        $karyawan = Karyawan::find($id);
        return view('backend.karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KaryawanUpdateRequest $request, string $id)
    {
        $request->validated();

        $karyawan = Karyawan::find($id);

        $karyawan->nama = $request->nama;
        $karyawan->jk = $request->jk;
        $karyawan->alamat = $request->alamat;
        $karyawan->notelp = $request->notelp;
        $karyawan->user->name = $request->username;

        if ($karyawan->user->email == $request->email) {
            $karyawan->user->email = $request->email;
        }

        if ($karyawan->user->password == $request->password) {
            $karyawan->user->password = $request->password;
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::find($id);
        $user = User::find($karyawan->user_id);

        $user->delete();
        $karyawan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Karyawan Berhasil Dihapus',
        ]);
    }
}
