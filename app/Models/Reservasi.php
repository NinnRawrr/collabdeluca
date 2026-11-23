<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $fillable = [
        'kamar_id', 
        'tamu_id', 
        'tanggal_checkin', 
        'tanggal_checkout', 
        'total_bayar', 
        'status'
    ];

    // Relasi: Reservasi milik 1 kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    // Relasi: Reservasi milik 1 tamu
    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'tamu_id');
    }
}
