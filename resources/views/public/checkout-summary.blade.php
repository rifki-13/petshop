@extends('layouts.public')
@section('contents')
    <div class="pl-20">
        <p class="text-2xl">Checkout Summary</p>
        <div class="m-5">
            <table class="table-auto border border-solid border-black">
                <thead class="text-center ">
                <tr class="bg-blue-300">
                    <th class="border border-2 border-solid border-black p-2">No.</th>
                    <th class="border border-2 border-solid border-black p-2 w-2/4">Nama Produk</th>
                    <th class="border border-2 border-solid border-black p-2">Harga Satuan</th>
                    <th class="border border-2 border-solid border-black p-2">Jumlah</th>
                    <th class="border border-2 border-solid border-black p-2">Total Harga</th>
                </tr>
                </thead>
                @php $total = 0; @endphp
                @foreach($cart as $key=>$val)
                    <tbody>
                    <tr class="text-sm text-left">
                        <td class="border border-2 border-solid border-black p-2">{{$key = $key+1}}</td>
                        <td class="border border-2 border-solid border-black p-2">{{$val['nama']}}</td>
                        <td class="border border-2 border-solid border-black p-2">{{'Rp. '.number_format($val['harga'])}}</td>
                        <td class="border border-2 border-solid border-black p-2">{{$val['jumlah']}}</td>
                        <td class="border border-2 border-solid border-black p-2">{{'Rp. '.number_format($val['total_harga'])}}</td>
                    </tr>
                    </tbody>
                @php $total += $val['total_harga']; @endphp
                @endforeach
                <tfoot>
                <tr class="text-sm text-center">
                    <td class="border border-2 border-solid border-black p-2 text-left font-bold tracking-widest text-base" colspan="4">Total Keseluruhan</td>
                    <td class="border border-2 border-solid border-black p-2">{{'Rp. '.number_format($total)}}</td>
                </tr>
                </tfoot>
            </table>
            <form action="{{route('checkout')}}" method="post" class="mt-5" >
                @csrf
                <input name="cart" type="hidden" value="{{json_encode($cart)}}">
                <label for="metode">Metode Pembayaran</label><br>
                <select name="metode" id="metode">
                    <option selected>-- Pilih Metode Pembayaran --</option>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
                <button type="submit">Checkout</button>
            </form>
        </div>

    </div>

@endsection
