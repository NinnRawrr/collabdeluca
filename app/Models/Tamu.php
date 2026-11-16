<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $table = 'tamu';
    protected $fillable = ['nama', 'no_identitas', 'no_hp', 'email'];

    // Relasi: 1 tamu punya banyak reservasi
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'tamu_id');
    }
}