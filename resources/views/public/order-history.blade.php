@extends('layouts.public')
@section('contents')
    <div class="ml-14 mt-4">
        <h2 class="text-2xl mb-5 font-semibold ">Order History</h2>
        <table class="border border-solid border-black border-1 p-2 mb-5 ml-6">
            <tr>
                <th class="border border-solid border-black border-1 p-2">No</th>
                <th class="border border-solid border-black border-1 p-2">Nama Produk</th>
                <th class="border border-solid border-black border-1 p-2">Kategori</th>
                <th class="border border-solid border-black border-1 p-2">Jumlah</th>
                <th class="border border-solid border-black border-1 p-2">Harga</th>
                <th class="border border-solid border-black border-1 p-2">Total Harga</th>
                <th class="border border-solid border-black border-1 p-2">Status Bayar</th>
            </tr>
            @foreach($transaksi as $trans)
                <tr>
                    <th colspan="6" class="bg-blue-400 font-mono">{{$trans['nomor']}}</th>
                    <th rowspan="{{count($trans['item_transaksi'])+1}}"
                        class="border border-solid border-black border-1 p-2 font-medium"
                        x-data="{}"
                        :class="'{{$trans['status']}}' === 'lunas' ? 'bg-green-300' : 'bg-red-300'"
                        >
                        @if($trans['snap_token'] !== null) <button class="btn btn-primary" id="pay-button">Pay Now</button> @else {{ucwords($trans['status'])}} @endif
{{--                        {{ucwords($trans['status'])}}--}}
                    </th>
                </tr>
                @foreach($trans['item_transaksi'] as $item)
                    <tr>
                        <td class="border border-solid border-black border-1 p-2">{{ ++$count }}</td>
                        <td class="border border-solid border-black border-1 p-2">{{$item['produk']['nama']}}</td>
                        <td class="border border-solid border-black border-1 p-2">{{$item['produk']['kategori']['nama']}}</td>
                        <td class="border border-solid border-black border-1 p-2">{{$item['jumlah']}}</td>
                        <td class="border border-solid border-black border-1 p-2">{{number_format($item['harga'])}}</td>
                        <td class="border border-solid border-black border-1 p-2">{{number_format($item['total_harga'])}}</td>
                    </tr>

                @endforeach
            @endforeach
        </table>
    </div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snap_token }}', {
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
    });
</script>
@endsection
