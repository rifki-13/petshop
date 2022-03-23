<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

</style>

<h1>Data Item Transaksi</h1>
<a href="{{ route('item-transaksi.create') }}">Tambah Data</a>
<table>
    <thead>
        <th>Transaksi ID</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Total Harga</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($item as $item)
            <tr>
                <td>{{ $item->transaksi_id }}</td>
                <td>{{ $item->produk->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->total_harga }}</td>
                {{-- <td><a href="{{ route('transaksi.edit', $item->id) }}">edit</a>
                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="post">
                        @method("delete")
                        @csrf
                        <button type="submit">delete</button>
                    </form> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $item->links() !!}
