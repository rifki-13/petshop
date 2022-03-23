@extends('layouts.admin')
@section('contents')
    <form class="p-6 flex flex-col justify-center" action="{{ route('produk.update', $produk->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method("put")

        <x-my-input-form name='kode' type='text' showLabel='true' :value='$produk->kode' label='Kode Produk : '
            placeholder='Masukkan Kode Produk'></x-my-input-form>

        <x-my-select-form name="kategori" showLabel="true" label="Kategori Produk : " :value='$produk->kategori_id' :options="$kategori">
        </x-my-select-form>

        <x-my-input-form name='nama' type='text' showLabel='true' :value='$produk->nama' label='Nama Produk : '
            placeholder='Masukkan Nama Produk'></x-my-input-form>

        <x-my-input-form name='deskripsi' type='text' showLabel='true' :value='$produk->deskripsi' label='Deskripsi Produk : '
            placeholder='Deskripsi Produk'></x-my-input-form>

        <x-my-select-form name="jenis" showLabel="true" label="Jenis Produk : " value='' :options="$jenis">
        </x-my-select-form>

        <x-my-input-form name='stok' type='number' showLabel='true' :value='$produk->stok' label='Stok : ' placeholder='Stok'>
        </x-my-input-form>

        <x-my-input-form name='harga' type='number' showLabel='true' :value='$produk->harga' label='Harga : ' placeholder='Harga'>
        </x-my-input-form>

        <x-my-input-form name='photo' type='file' showLabel='true' value='' label='Gambar Produk : ' placeholder=''>
        </x-my-input-form>

        <button type="submit"
            class="md:w-32 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">Submit</button>
    </form>
@endsection


{{-- 
<h1>Form edit data produk</h1>
<form action="{{ route('produk.update', $produk->id) }}" method="post">
    @method("put")
    @csrf
    <label for="kode">Kode Produk</label>
    <input type="text" name="kode" id="kode" value="{{ $produk->kode }}"><br>
    @error('kode')
        <div>{{ $message }}</div>
    @enderror
    <label for="kategori">Kategori Produk</label>
    <select name="kategori" id="kategori">
        @foreach ($kategori as $k)
            @if ($produk->kategori->id === $k->id)
                <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
            @else
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endif
        @endforeach
    </select><br>
    <label for="nama">Nama Produk</label>
    <input type="text" name="nama" id="nama" value="{{ $produk->nama }}"><br>
    @error('nama')
        <div>{{ $message }}</div>
    @enderror
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" cols="20" rows="2">{{ $produk->deskripsi }}</textarea><br>
    @error('deskripsi')
        <div>{{ $message }}</div>
    @enderror
    <label for="jenis">Jenis</label>
    <select name="jenis" id="jenis">
        <option value="jasa" @if ($produk->jenis === 'jasa')
            selected
            @endif>Jasa</option>
        <option value="produk" @if ($produk->jenis === 'produk')
            selected
            @endif>Produk</option>
    </select><br>
    <label for="stok">Stok</label>
    <input type="number" name="stok" id="stok" value="{{ $produk->stok }}"><br>
    @error('stok')
        <div>{{ $message }}</div>
    @enderror
    <label for="harga">Harga Satuan</label>
    <input type="number" name="harga" id="harga" value="{{ $produk->harga }}"><br>
    @error('harga')
        <div>{{ $message }}</div>
    @enderror
    <button type="submit">Submit</button>
</form> --}}
