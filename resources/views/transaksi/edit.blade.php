@extends('layouts.admin')
@section('contents')
    <h1>Form edit data transaksi</h1>
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="post">
        @method("put")
        @csrf
        <label for="nomor">Nomor Transaksi</label>
        <input type="text" name="nomor" id="nomor" value="{{ $transaksi->nomor }}">
        @error('nomor')
            <p>{{ $message }} </p>
        @enderror
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $transaksi->tanggal }}">
        @error('tanggal')
            <p>{{ $message }} </p>
        @enderror
        <label for="total_harga">Total Harga:</label>
        <input type="number" name="total_harga" id="total_harga" value="{{ $transaksi->total_harga }}">
        @error('total_harga')
            <p>{{ $message }} </p>
        @enderror
        <label for="user_id">User</label>
        <select name="user_id" id="user_id">
            @foreach ($user as $user)
                <option value="{{ $user->id }}" @if ($user->id === $transaksi->user_id) selected @endif>{{ $user->name }}

                </option>
            @endforeach
        </select>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="belum bayar" @if ($transaksi->status === 'belum bayar') selected @endif>Belum Bayar</option>
            <option value="lunas" @if ($transaksi->status === 'belum bayar') selected @endif>Lunas</option>
        </select>
        <br><br>
        <button type="submit">Submit</button>
    </form>
@endsection
