<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';
    protected $fillable = ['nama_tipe', 'harga_per_malam', 'fasilitas'];

    // Relasi: 1 tipe kamar punya banyak kamar
    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar_id');
    }
}
