<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Tamu;
use App\Models\TipeKamar;

class DashboardController extends Controller
{
    // Halaman Dashboard: 4 kartu jumlah data per tabel
    public function index()
    {
        $jumlah = [
            'tipe_kamar' => TipeKamar::count(),
            'kamar'      => Kamar::count(),
            'tamu'       => Tamu::count(),
            'reservasi'  => Reservasi::count(),
        ];

        return view('dasboard.dashboard', compact('jumlah'));
    }
}
