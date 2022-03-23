@extends('layouts.admin')
@section('contents')
    <form class="p-6 flex flex-col justify-center" action="{{ route('produk.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <x-my-input-form name='kode' type='text' showLabel='true' value='' label='Kode Produk : '
            placeholder='Masukkan Kode Produk'></x-my-input-form>

        <x-my-select-form name="kategori" showLabel="true" label="Kategori Produk : " value='' :options="$kategori">
        </x-my-select-form>

        <x-my-input-form name='nama' type='text' showLabel='true' value='' label='Nama Produk : '
            placeholder='Masukkan Nama Produk'></x-my-input-form>

        <x-my-input-form name='deskripsi' type='text' showLabel='true' value='' label='Deskripsi Produk : '
            placeholder='Deskripsi Produk'></x-my-input-form>

        <x-my-select-form name="jenis" showLabel="true" label="Jenis Produk : " value='' :options="$jenis">
        </x-my-select-form>

        <x-my-input-form name='stok' type='number' showLabel='true' value='' label='Stok : ' placeholder=''>
        </x-my-input-form>

        <x-my-input-form name='harga' type='number' showLabel='true' value='' label='Harga : ' placeholder=''>
        </x-my-input-form>

        <x-my-input-form name='photo' type='file' showLabel='true' value='' label='Gambar Produk : ' placeholder=''>
        </x-my-input-form>

        <button type="submit"
            class="md:w-32 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">Submit</button>
    </form>
@endsection
