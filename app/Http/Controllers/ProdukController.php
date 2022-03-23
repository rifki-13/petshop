<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["produk"] = Produk::with('kategori')->orderBy('id', 'desc')->paginate(2);
        return view('produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data["kategori"] = Kategori::all();
        $kategori = Kategori::pluck('nama', 'id');
        $data['kategori'] = $kategori;
        $jenis = array(
            'jasa' => 'Jasa',
            'produk' => 'Produk'
        );
        $data['jenis'] = $jenis;
        return view("produk.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "kode" => "required|unique:produks,kode",
            "kategori" => "required",
            "nama" => "required|unique:produks,nama",
            "jenis" => "required",
            "stok" => "required",
            "harga" => "required"
        ]);
        $produk = new Produk();
        $produk->kode = $request->kode;
        $produk->kategori_id = $request->kategori;
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->jenis = $request->jenis;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;
        $file = $request->photo;
        $store = $file->storeAs("/images", $file->getClientOriginalName());
        $produk->photo = $file->getClientOriginalName();
        $produk->save();



        return redirect()->action([ProdukController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["produk"] = Produk::findOrFail($id);
        $kategori = Kategori::pluck('nama', 'id');
        $data['kategori'] = $kategori;
        $jenis = array(
            'jasa' => 'Jasa',
            'produk' => 'Produk'
        );
        $data['jenis'] = $jenis;

        return view('produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "kode" => "required",
            "kategori" => "required",
            "nama" => "required",
            "deskripsi" => "required",
            "jenis" => "required",
            "stok" => "required|min:0",
            "harga" => "required|min:0"
        ]);
        $produk = Produk::find($id);
        $produk->kode = $request->kode;
        $produk->kategori_id = $request->kategori;
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->jenis = $request->jenis;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;
        $file = $request->photo;
        $store = $file->storeAs("/images", $file->getClientOriginalName());
        $produk->photo = $file->getClientOriginalName();
        $produk->save();

        return redirect()->action([ProdukController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect()->action([ProdukController::class, 'index']);
    }
}
