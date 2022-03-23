<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    use HasFactory;
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}