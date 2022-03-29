@extends('layouts.public')
@section('contents')
    <div class="ml-14 mt-4">
        <h1 class="font-semibold text-2xl">Order History</h1>
        @foreach($transaksi as $trans)
            <div class="bg-gray-100 border border-solid border-1 shadow-xl p-5 m-5 w-1/2">
                <h2 class="font-normal text-lg underline decoration-solid">{{$trans->nomor}}</h2>
                @foreach($trans->itemTransaksi as $item)
                    <div class="ml-12 p-3">
                        <p class="mb-2 ">{{$item->produk->nama}}</p>
                        <div class="relative flex flex-row">
                            <img src="{{ route('cloud.images', $item->produk->photo) }}" loading="lazy" class="w-24 h-24">
                            <div class="ml-4 mb-5">
                                <p>{{$item->produk->kategori->nama}}</p>
                                <p>{{$item->jumlah}}</p>
                                <p>{{$item->harga}}</p>
                                <p>{{$item->total_harga}}</p>
                            </div>
                            @if($loop->last)
                                <div class="absolute bottom-0 right-0 @if($trans->status ==="lunas") bg-green-300 @else  bg-red-300 @endif rounded-2xl">
                                    <p class="m-2">{{$trans->status}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        {!! $transaksi->links() !!}
    </div>
@endsection
