<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    public function jadwal_reservasi() {
        return $this->hasOne(JadwalReservasi::class,  'id', 'tanggal_reservasi');
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function produk() {
        return $this->hasOne(Produk::class, 'id', 'produk_id');
    }
}
