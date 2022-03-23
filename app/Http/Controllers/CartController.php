<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $request->validate(
            ["jumlah" => "min:1"]
        );

        $alreadyThere = Cart::where([
            ['produk_id', "=", $request->produk_id],
            ['user_id', "=", Auth::user()->id],
        ])->first();
        $produk = Produk::find($request->produk_id);
        $stok = $produk->stok;

        if ($alreadyThere) {
            $cart = $alreadyThere;
            $cart->jumlah += $request->jumlah;
            abort_if($cart->jumlah > $stok, '406', 'Jumlah produk melebihi stok');
            $cart->total_harga = $cart->jumlah * $cart->harga;

            $cart->update();
        } else {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->produk_id = $request->produk_id;
            $cart->jumlah = $request->jumlah;
            abort_if($cart->jumlah > $stok, '406', 'Jumlah produk melebihi stok');
            $cart->harga = $request->harga;
            $cart->total_harga = $request->jumlah * $request->harga;

            $cart->save();
        }

        return redirect()->action([StoreController::class, 'index']);
    }

    public function removeCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->action([StoreController::class, 'index']);
    }
}
