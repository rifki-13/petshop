@extends('layouts.admin')
@section('contents')
    <h1>Form tambah data user</h1>
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name"><br>
        @error('name')
            <p>{{ $message }} </p>
        @enderror
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        @error('email')
            <p>{{ $message }} </p>
        @enderror
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        @error('password')
            <p>{{ $message }} </p>
        @enderror
        <label for="hak_akses">Hak Akses</label>
        <select name="hak_akses" id="hak_akses">
            <option value="pelanggan">Pelanggan</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Submit</button>
    </form>
@endsection
