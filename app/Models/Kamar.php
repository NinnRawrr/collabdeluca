<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $fillable = ['tipe_kamar_id', 'nomor_kamar', 'lantai', 'status'];

    // Relasi: Kamar milik 1 tipe kamar
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
    }

    // Relasi: 1 kamar punya banyak reservasi
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'kamar_id');
    }
}
