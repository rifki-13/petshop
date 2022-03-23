@extends('layouts.base')

@section('body')
    <div class="bg-white max-w-screen">
        @include('layouts.parts.public-header')
        @yield('contents')
    </div>
@endsection
