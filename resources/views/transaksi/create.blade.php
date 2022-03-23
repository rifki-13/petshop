@extends('layouts.admin')
@section('contents')
    <h1>Form tambah data transaksi</h1>
    <form action="{{ route('transaksi.store') }}" method="post">
        @csrf
        <label for="nomor">Nomor Transaksi</label>
        <input type="text" name="nomor" id="nomor">
        @error('nomor')
            <p>{{ $message }} </p>
        @enderror
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal">
        @error('tanggal')
            <p>{{ $message }} </p>
        @enderror
        <label for="total_harga">Total Harga:</label>
        <input type="number" name="total_harga" id="total_harga">
        @error('total_harga')
            <p>{{ $message }} </p>
        @enderror
        <label for="user_id">User</label>
        <select name="user_id" id="user_id">
            @foreach ($user as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="belum bayar">Belum Bayar</option>
            <option value="lunas">Lunas</option>
        </select>
        <br><br>
        <button type="submit">Submit</button>
    </form>
@endsection
