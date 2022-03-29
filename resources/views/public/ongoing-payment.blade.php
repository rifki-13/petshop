@extends('layouts.public')
@section('contents')
    <div class="ml-14 mt-4">
        <h1 class="font-semibold text-2xl">Ongoing Payment</h1>
        @foreach($transaksi as $trans)
            <div class="relative bg-gray-100 border border-solid border-1 shadow-xl p-5 m-5 w-1/2">
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
                                <div class="absolute bottom-0 right-0 rounded-2xl">
                                    <button
                                            onclick="pay('{{$trans->snap_token}}')"
                                            class="p-2 rounded-lg bg-blue-400"
                                    >Pay Now
                                    </button>
                                </div>
                                <div class="absolute bottom-0 right-24 rounded-2xl">
                                    <form method="post" action="{{route('cancel-payment')}}" style="display:inline">
                                        @csrf
                                        <input type="hidden" value="{{$trans->nomor}}" name="order_id">
                                        <button class="p-2 rounded-lg bg-red-400">
                                            Cancel
                                        </button>
                                    </form>

                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        @endforeach
        {!! $transaksi->links() !!}
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        function pay(snap_token){
            snap.pay(snap_token, {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        }
    </script>
@endsection
