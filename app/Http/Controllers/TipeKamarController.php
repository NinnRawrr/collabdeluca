<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeKamar;  

class TipeKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipeKamar = TipeKamar::all();
        return view('tipe_kamar.index', compact('tipeKamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe-kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Sesuaikan nama field validasi dengan yang ada di database & form HTML
    $request->validate([
        'nama_tipe'       => 'required|string|max:255',
        'harga_per_malam' => 'required|integer',
        'fasilitas'       => 'nullable|string',
    ]);

    // Simpan ke database
    TipeKamar::create([
        'nama_tipe'       => $request->nama_tipe,
        'harga_per_malam' => $request->harga_per_malam,
        'fasilitas'       => $request->fasilitas,
    ]);

    return redirect()->back()->with('success', 'Tipe kamar berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);
        return view('tipe-kamar.show', compact('tipeKamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);
        return view('tipe-kamar.edit', compact('tipeKamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0'
        ]);

        $tipeKamar = TipeKamar::findOrFail($id);
        $tipeKamar->update($request->all());

        return redirect()->route('tipe-kamar.index')
                         ->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);
        $tipeKamar->delete();

        return redirect()->route('tipe-kamar.index')
                         ->with('success', 'Tipe kamar berhasil dihapus.');
    }
}
