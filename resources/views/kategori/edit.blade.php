@extends('layouts.admin') 
@section('contents')
    <h1>Form edit data kategori</h1>
    <form class="p-6 flex flex-col justify-center" action="{{ route('kategori.update', $kategori->id)}}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('form.form-input', [
        'name'=>'name',
        'type'=>'text',
        'showLabel'=>true,
        'value'=> old('name') ?? $kategori->nama,
        'label'=>'Nama Kategori',
        'placeholder'=>'Masukkan nama kategori'
        ])
        <button type="submit"
            class="md:w-32 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">Submit</button>
    </form>
@endsection
