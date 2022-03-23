<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["transaksi"] = Transaksi::with("user")->paginate(10);
        return view("transaksi.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["user"] = User::all();
        return view("transaksi.create", $data);
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
            "nomor" => "required",
            "tanggal" => "required",
            "total_harga" => "required",
            "user_id" => "required",
            "status" => "in:belum bayar, lunas|required"
        ]);

        $transaksi = new Transaksi;
        $transaksi->nomor = $request->nomor;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->user_id = $request->user_id;
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->action([TransaksiController::class, 'index']);
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
        $data['transaksi'] = Transaksi::find($id);
        $data['user'] = User::all();
        return view("transaksi.edit", $data);
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
            "nomor" => "required",
            "tanggal" => "required",
            "total_harga" => "required",
            "user_id" => "required",
            "status" => "in:belum bayar, lunas|required"
        ]);

        $transaksi = Transaksi::find($id);
        $transaksi->nomor = $request->nomor;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->user_id = $request->user_id;
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->action([TransaksiController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        return redirect()->action([TransaksiController::class, 'index']);
    }
}
