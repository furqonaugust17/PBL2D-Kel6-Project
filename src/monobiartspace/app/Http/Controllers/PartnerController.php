<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('backend.partner.index', [
            'partners' => Partner::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'nohp' => 'required|string|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'deskripsi' => 'required|string|max:255',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        Partner::create([
            'name' => $request->name,
            'phone' => $request->nohp,
            'image' => $imageName,
            'description' => $request->deskripsi,
        ]);
        
        return redirect()->route('partner.index')->with('success', 'Partner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        //
        return view('backend.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        //
        $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'image' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $partner->image = $imageName;
        }

        $partner->update([
            'name' => $request->name,
            'phone' => $request->nohp,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('partner.index')->with('success', 'Partner berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        //
        $partner->delete();
        return redirect()->route('partner.index')->with('success', 'Partner berhasil dihapus');
    }
}
