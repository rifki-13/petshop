@php ob_start() @endphp
@extends('layouts.public', [$cart ?? [], $reservasi ?? []])
@section('contents')
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8"
        x-data="{ openModal: false, product: [], imgUrl: '', jumlah:1, cartUrl: '', kategori: ''}">
        <h2 class="sr-only">Products</h2>
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            @foreach ($produk as $p)
                    <button type="button"
                        @click="openModal=true, product={{ $p }}, imgUrl='{{ route('cloud.images', $p->photo) }}', cartUrl='{{ route('cart.addCart') }}', kategori='{{ $p->kategori->nama }}'"
                        class="group">
                        <div
                            class="w-60 aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                            <img src="{{ route('cloud.images', $p->photo) }}" alt="{{ $p->deskripsi }}"
                                class="w-60 h-60 object-center object-fill group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">{{ $p->nama }}</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ 'Rp. ' . number_format($p->harga) }}</p>
                    </button>
            @endforeach

        </div>
        @include('form.modal-product')
    </div>
@endsection
