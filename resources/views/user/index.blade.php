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
    <a href="{{ route('user.create') }}">Tambah Data</a>
    <table>
        <thead>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->hak_akses }}</td>
                    <td><a href="{{ route('user.edit', $item->id) }}">edit</a>
                        <form action="{{ route('user.destroy', $item->id) }}" method="post">
                            @method("delete")
                            @csrf
                            <button type="submit">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $user->links() !!}
@endsection
