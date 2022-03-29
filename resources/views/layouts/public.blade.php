@extends('layouts.base')

@section('body')
    <div class="bg-white max-w-screen">
        @include('layouts.parts.public-header')
        @yield('contents')
    </div>
    <script>
        openPusher();//buka koneksi ke socket
        //cek if on received notification then trigger listen channel broadcast
        Echo.channel('payment-status-{{Auth::user() != null ? Auth::user()->id : '0'}}')
            .listen('.app.payment-status', (e) => {
                console.log('listened');
            })
    </script>
@endsection
