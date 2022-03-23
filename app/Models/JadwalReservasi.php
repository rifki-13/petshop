<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalReservasi extends Model
{
    use HasFactory;
    public function list_jam() {
        return $this->hasMany(self::class, 'tanggal', 'tanggal');
    }
    public function reservasi() {
        return $this->belongsTo(Reservasi::class, 'id', 'tanggal_reservasi');
    }
}
