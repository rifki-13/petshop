<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ItemTransaksi;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\Midtrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Notification;

class PaymentController extends Controller
{

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        $cart = json_decode($request->cart);
        $total_harga = 0;
        foreach($cart as $c){
            $total_harga += $c->total_harga;
        }

        $transaksi = new Transaksi();
        $transaksi->tanggal = Carbon::now();
        $transaksi->total_harga = $total_harga;
        $transaksi->user_id = Auth::user()->id;
        $metode = '';
        $request->metode === "cash" ? $metode = "csh-" : $metode = "trx-";
        $transaksi->nomor = $metode . Carbon::now()->format('d-m-Y h:i:s') . '-' . Auth::user()->id;

        $transaksi->save();

        $order['nomor'] = $transaksi->nomor;
        $order['total'] = $total_harga;
        $order['item_details'] = [];

        foreach($cart as $key=>$c){
            $item = new ItemTransaksi();
            $item->transaksi_id = $transaksi->id;
            $item->produk_id = $c->produk_id;
            $item->jumlah = $c->jumlah;
            $item->harga = $c->harga;
            $item->total_harga = $c->total_harga;
            $item->save();
            $order['item_details'][] = $item->toArray();

            $produk = Produk::find($c->produk_id);
            $produk->stok = $produk->stok - $c->jumlah;
            $produk->save();

            $order['item_details'][$key]['nama'] = $produk->nama;

            $cart = Cart::find($c->id);
            $cart->delete();
        }

        if($request->metode === 'transfer'){
            $midtrans = new CreateSnapTokenService($order);

            $transaksi->snap_token = $midtrans->getSnapToken();
            $transaksi->save();
        } else {
            $pembayaran = new Pembayaran();
            $pembayaran->transaksi_id = $transaksi->id;
            $pembayaran->jumlah_bayar = $total_harga;
            $pembayaran->metode_bayar = $request->metode;
            $pembayaran->save();

            $transaksi->status = 'lunas';
            $transaksi->save();
        }



        DB::commit();
        return redirect()->action([StoreController::class, 'index']);

    }

    public function notification(Request $request){
        $midtrans = new Midtrans();
        $notif = new Notification();
        $response = $notif->getResponse();
        $transaksi = Transaksi::where('nomor', $response->order_id)->first();
        if($response->transaction_status === 'settlement'){
            $transaksi->status = 'lunas';
            $transaksi->save();
        }

        $pembayaran = new Pembayaran();
        $pembayaran->transaksi_id = $transaksi->id;
        $pembayaran->jumlah_bayar = $response->gross_amount;
        $pembayaran->metode_bayar = 'transfer';
        $pembayaran->tanggal_pembayaran = $response->settlement_time;
        $pembayaran->payment_type = $response->payment_type;
        $pembayaran->save();

        return response()->json(['success' => 'success'], 200);
    }
}
