@extends('layouts.admin')
@section('contents')
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>

    <h1>Data User</h1>
    <a href="{{ route('transaksi.create') }}">Tambah Data</a>
    <table>
        <thead>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->total_harga }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->status }}</td>
                    <td><a href="{{ route('transaksi.edit', $item->id) }}">edit</a>
                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="post">
                            @method("delete")
                            @csrf
                            <button type="submit">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $transaksi->links() !!}
@endsection
