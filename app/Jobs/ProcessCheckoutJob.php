<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\ItemTransaksi;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Services\Midtrans\CreateSnapTokenService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcessCheckoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        $cart = json_decode($this->request->cart);
        $total_harga = 0;
        foreach($cart as $c){
            $total_harga += $c->total_harga;
        }

        $transaksi = new Transaksi();
        $transaksi->tanggal = Carbon::now();
        $transaksi->total_harga = $total_harga;
        $transaksi->user_id = Auth::user()->id;
        $metode = '';
        $this->request->metode === "cash" ? $metode = "csh-" : $metode = "trx-";
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

        if($this->request->metode === 'transfer'){
            $midtrans = new CreateSnapTokenService($order);

            $transaksi->snap_token = $midtrans->getSnapToken();
            $transaksi->save();
        } else {
            $pembayaran = new Pembayaran();
            $pembayaran->transaksi_id = $transaksi->id;
            $pembayaran->jumlah_bayar = $total_harga;
            $pembayaran->metode_bayar = $this->request->metode;
            $pembayaran->save();

            $transaksi->status = 'lunas';
            $transaksi->save();
        }

        DB::commit();
    }
}
