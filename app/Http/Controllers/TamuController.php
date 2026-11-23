<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamu = Tamu::all();
        return view('tamu.index', compact('tamu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tamu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:50|unique:tamu,no_identitas',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255|unique:tamu,email',
        ]);

        Tamu::create($request->all());

        return redirect()->route('tamu.index')
                         ->with('success', 'Tamu berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('tamu.show', compact('tamu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('tamu.edit', compact('tamu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tamu = Tamu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:50|unique:tamu,no_identitas,' . $tamu->id,
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255|unique:tamu,email,' . $tamu->id,
        ]);

        $tamu->update($request->all());

        return redirect()->route('tamu.index')
                         ->with('success', 'Tamu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->route('tamu.index')
                         ->with('success', 'Tamu berhasil dihapus.');
    }
}
