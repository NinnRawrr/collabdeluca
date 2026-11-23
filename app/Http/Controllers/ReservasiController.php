<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Kamar;
use App\Models\Tamu;
use App\Models\TipeKamar;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi = Reservasi::with(['kamar.tipeKamar', 'tamu'])->get();
        return view('reservasi.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // app/Http/Controllers/ReservasiController.php
    public function create()
    {
        $kamars = Kamar::with('tipeKamar')
            ->where('status', 'tersedia') // pastikan nama kolom & nilainya sama persis dengan di DB
            ->get();

        // ... kode lainnya (misalnya data tamu)
        return view('reservasi.create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'tamu_id' => 'required|exists:tamu,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'total_bayar' => 'required|numeric',
            'status' => 'required|string'
        ]);

        Reservasi::create($request->all());

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasi = Reservasi::with(['kamar.tipeKamar', 'tamu'])->findOrFail($id);
        return view('reservasi.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $kamar = Kamar::with('tipeKamar')->get();
        $tamu = Tamu::all();
        return view('reservasi.edit', compact('reservasi', 'kamar', 'tamu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'tamu_id' => 'required|exists:tamu,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'total_bayar' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->all());

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }
}
