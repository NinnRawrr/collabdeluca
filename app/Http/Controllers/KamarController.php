<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;


class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar = Kamar::with('tipeKamar')->get();
        $tipeKamar = TipeKamar::all();
        return view('kamar.index', compact('kamar', 'tipeKamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipeKamar = TipeKamar::all();
        return view('kamar.create', compact('tipeKamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'nomor_kamar' => 'required|string|max:10',
            'lantai' => 'required|integer',
            'status' => 'required|string'
        ]);

        Kamar::create($request->all());

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar = Kamar::with('tipeKamar')->findOrFail($id);
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        $tipeKamar = TipeKamar::all();
        return view('kamar.edit', compact('kamar', 'tipeKamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'nomor_kamar' => 'required|string|max:10',
            'lantai' => 'required|integer',
            'status' => 'required|string'
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil dihapus.');
    }
}
