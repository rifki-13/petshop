@extends('layouts.admin')
@section('contents')
    <h1>Form edit data user</h1>
    <form action="{{ route('user.update', $user->id) }}" method="post">
        @method("put")
        @csrf
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="{{ $user->password }}"><br>
        <label for="hak_akses">Hak Akses</label>
        <select name="hak_akses" id="hak_akses">
            <option value="pelanggan" @if ($user->hak_akses === 'pelanggan') selected @endif>Pelanggan</option>
            <option value="admin" @if ($user->hak_akses === 'admin') selected @endif>Admin</option>
        </select><br><br>
        <button type="submit">Submit</button>
    </form>
@endsection
