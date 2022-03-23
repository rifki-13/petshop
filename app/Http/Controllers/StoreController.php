<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaksi;
use App\Models\JadwalReservasi;
use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Reservasi;
use App\Models\Transaksi;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::all();

        $data['tgl_reservasi'] = JadwalReservasi::with(['list_jam' => function($q) {
            $q->where('status_reservasi', 'open')->select('id', 'jam', 'tanggal', 'status_reservasi');
        }])
            ->select('tanggal')
            ->whereDate('tanggal', '>=', Carbon::now()->startOfWeek()->toDateString())
            ->groupBy('tanggal')
            ->get();
        return view('public.index', $data);
    }

    public function indexJenis($jenis)
    {
        $data['produk'] = Produk::where('jenis', '=', $jenis)->get();

        $data['tgl_reservasi'] = JadwalReservasi::with(['list_jam' => function($q) {
            $q->where('status_reservasi', 'open')->select('id', 'jam', 'tanggal', 'status_reservasi');
        }])
            ->select('tanggal')
            ->whereDate('tanggal', '>=', Carbon::now()->startOfWeek()->toDateString())
            ->groupBy('tanggal')
            ->get();
        return view('public.index', $data);
    }

    public function getCart()
    {
        if (Auth::check() && Auth::user()->hak_akses === "pelanggan") {
            $listCart = Cart::where('user_id', Auth::user()->id)->get();
            if (!count($listCart)) {
                $cart = null;
            } else {
                foreach ($listCart as $c) {
                    $produk = Produk::find($c->produk_id);
                    $cartDetail['id'] = $c->id;
                    $cartDetail['produk_id'] = $c->produk_id;
                    $cartDetail['nama'] = $produk->nama;
                    $cartDetail['kategori'] = $produk->kategori->nama;
                    $cartDetail['gambar'] = $produk->photo;
                    $cartDetail['jumlah'] = $c->jumlah;
                    $cartDetail['harga'] = $c->harga;
                    $cartDetail['total_harga'] = $c->total_harga;
                    $cart[] = $cartDetail;
                }
            }
        } else
            $cart = null;
        return $cart;
    }

    public function getReservasi() {
        if (Auth::check() && Auth::user()->hak_akses === "pelanggan") {
            $listReservasi = Reservasi::with('jadwal_reservasi')
                                    ->with('produk')
                                    ->with('user')
                                    ->where('user_id', Auth::user()->id)->get();
            if (!count($listReservasi)) {
                $reservasi = null;
            } else $reservasi = $listReservasi;
        } else
            $reservasi = null;
        return $reservasi;
    }

    public function checkoutSummary()
    {
        $cart = $this->getCart();
        $data['cart'] = $cart;
//        dd($data);die;
        return view('public.checkout-summary', $data);
    }

    public function search(Request $request){
        $produk = Produk::where('nama', 'like', '%'.$request->search.'%')->get();
        $data['produk'] =$produk;

        return view('public.index', $data);
    }

    public function reservasi(Request $request) {
        $reservasi = new Reservasi();
        $reservasi->user_id = Auth::user()->id;
        $reservasi->produk_id = $request->produk_id;
        $reservasi->deskripsi_reservasi = $request->deskripsi;
        $reservasi->tanggal_reservasi = $request->jam;
        $reservasi->save();

        return redirect()->action([StoreController::class, 'index']);
    }

    public function order_history(){
        $transaksi = Transaksi::with(['itemTransaksi.produk.kategori'])
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('id', 'desc')
                            ->get();

        $data['transaksi'] = $transaksi->toArray();
        $data['count'] = 0;
        $data['snap_token'] = $transaksi->first()->snap_token;
        return view('public.order-history', $data);
    }
}
