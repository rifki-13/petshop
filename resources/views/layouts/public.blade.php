@extends('layouts.base')

@section('body')
    <div class="bg-white max-w-screen">
        @include('layouts.parts.public-header')
        @yield('contents')
        <div id="notif"
             class="fixed right-10 bottom-10 flex items-center justify-between max-w-xs p-4 bg-white border rounded-md shadow-sm"
             x-data="showNotif" x-show="show">
            <div class="flex inline-flex items-center">
                <template x-if="status_order === 'Berhasil'">
                    {{--Success--}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-500" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                </template>
                <template x-if="status_order === 'Gagal'">
                    {{--                Fail--}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </template>
                <template x-if="status_order === 'Pending'">
                    {{--                Info--}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </template>
                <p
                    class="ml-3 text-sm font-normal"
                >Pembayaran nomor
                    '<span class="font-medium" x-text="order_id"></span>'
                    <span :class="txtColor" class="font-bold text-base" x-text="status_order + '. '"></span>
                    <span x-text="addTxt"></span>

                </p>
            </div>
            <span class="ml-3 inline-flex items-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" @click="close">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </span>
        </div>
        <script type="text/javascript">
            openPusher();//buka koneksi ke socket
            document.addEventListener('alpine:init', () => {
                Alpine.data('showNotif', () => ({
                    show: false,
                    status_order: 'Berhasil',
                    order_id: '',
                    txtColor: '',
                    addTxt: '',
                    close() {
                        this.show = !this.show
                    }
                }))
            })
            document.addEventListener('alpine:initialized', () => {
                console.log(document.getElementById("notif")._x_dataStack[0]);
            })
            //cek if on received notification then trigger listen channel broadcast
            Echo.channel('payment-status-{{Auth::user() != null ? Auth::user()->id : '0'}}')
                .listen('.app.payment-status', (e) => {
                    let eleNotif = document.getElementById("notif")._x_dataStack[0];
                    eleNotif.show = true;
                    if (e.status === 'lunas') {
                        eleNotif.status_order = 'Berhasil';
                        eleNotif.txtColor = 'text-green-600';
                    } else if (e.status === 'gagal') {
                        eleNotif.status_order = 'Gagal';
                        eleNotif.txtColor = 'text-red-600';
                        eleNotif.addTxt = 'Transaksi di batalkan dan order anda telah di hapus';
                    } else if (e.status === 'pending') {
                        eleNotif.status_order = 'Pending';
                        eleNotif.txtColor = 'text-blue-600';
                        eleNotif.addTxt = 'Silahkan segera lakukan pembayaran.';
                    }
                    eleNotif.order_id = e.order_id;
                });
        </script>
@endsection
