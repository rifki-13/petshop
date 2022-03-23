<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="{{ route('store.index') }}">
                    <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                        alt="Home">
                </a>
            </div>
            <nav class="hidden md:flex space-x-10" x-data="{dropdown: false}">
                <div class="relative mx-auto text-gray-600">
                    <form method="get" action="{{route('store.search')}}">
                        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Search">
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="relative mt-1">
                    <button type="button" @click="dropdown=!dropdown"
                        class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        aria-expanded="false">
                        <span>Jenis</span>
                        <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div
                        class="absolute z-10 -ml-4 mt-1 transform px-2 w-24 max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
                            x-show="dropdown">
                            <div class="relative grid bg-white px-2 py-2 sm:gap-8 sm:p-8">
                                <a href="{{ route('store.index.jenis', 'jasa') }}"
                                    class="-m-3 p-2 flex items-start rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-800">
                                    <div class="ml-0">
                                        <p class="text-base font-medium text-center">Jasa</p>
                                    </div>
                                </a>
                                <a href="{{ route('store.index.jenis', 'produk') }}"
                                    class="-m-3 p-2 flex items-start rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-800">
                                    <div class="ml-0">
                                        <p class="text-base font-medium text-center">Produk</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            @if (Auth::check())
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    <div class="inline-flex relative w-fit" x-data="{showCart : false, showReserv : false}">
                        @if (isset($cart))
                            <div x-show="!showCart"
                                class="absolute inline-block top-0 right-auto bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-indigo-700 text-white rounded-full z-10app">
                                {{ count($cart) }}</div>
                            <button @click="showCart = !showCart">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                            </button>

                            <!--  shopping cart     -->
                            <div class="absolute pointer-events-auto w-screen max-w-sm right-0 top-4" x-show="showCart">
                                <div class="flex h-full flex-col bg-white shadow-xl" @click.away="showCart = false">
                                    <div class="flex-1 py-6 px-4 sm:px-6 border-black">
                                        <div class="flex items-start justify-between">
                                            <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping
                                                cart</h2>
                                            <div class="ml-3 flex h-7 items-center">
                                                <button type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500"
                                                    @click="showCart = false">
                                                    <span class="sr-only">Close panel</span>
                                                    <!-- Heroicon name: outline/x -->
                                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        @php
                                            $total_cart = 0;
                                        @endphp
                                        <div class="mt-8 overflow-y-auto ">
                                            <div class="flow-root">
                                                {{-- list item cart --}}
                                                <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                    @foreach ($cart as $c)
                                                        @php
                                                            $total_cart += $c['total_harga'];
                                                        @endphp
                                                        <li class="flex py-6">
                                                            <div
                                                                class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                                <img src="{{ route('cloud.images', $c['gambar']) }}"
                                                                    alt="{{ $c['gambar'] }}"
                                                                    class="h-full w-full object-cover object-center">
                                                            </div>

                                                            <div class="ml-4 flex flex-1 flex-col">
                                                                <div>
                                                                    <div
                                                                        class="flex justify-between text-base font-medium text-gray-900">
                                                                        <h3>
                                                                            <a href="#">{{ $c['nama'] }} </a>
                                                                        </h3>
                                                                        <p class="ml-4">
                                                                            {{ number_format($c['total_harga']) }}
                                                                        </p>
                                                                    </div>
                                                                    <p class="mt-1 text-sm text-gray-500">@
                                                                        {{ number_format($c['harga']) }}</p>
                                                                </div>
                                                                <div
                                                                    class="flex flex-1 items-end justify-between text-sm">
                                                                    <p class="text-gray-500">Qty {{ $c['jumlah'] }}
                                                                    </p>

                                                                    <div class="flex">
                                                                        <form
                                                                            action="{{ route('cart.removeCart', $c['id']) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit"
                                                                                class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <p>Subtotal</p>
                                            <p>Rp {{ number_format($total_cart) }}</p>
                                        </div>
                                        <div class="mt-6">
                                            <a href="{{route('checkout')}}"
                                                class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                                        </div>
                                        <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                            <p>
                                                or <button type="button"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">Continue
                                                    Shopping<span aria-hidden="true"> &rarr;</span></button>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endif
                        @if(isset($reservasi))
                            <div x-show="!showReserv"
                                 class="absolute inline-block top-0 -right-2 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-indigo-700 text-white rounded-full z-10app">
                                {{ count($reservasi) }}</div>
                            <button @click="showReserv = !showReserv">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                </svg>
                            </button>

                            <!-- reservasi cart    -->
                            <div class="absolute pointer-events-auto w-screen max-w-sm right-0 top-4" x-show="showReserv">
                                <div class="flex h-screen flex-col bg-white shadow-xl" @click.away="showReserv = false">
                                    <div class="flex-1 py-6 px-4 sm:px-6 border-black">
                                        <div class="flex items-start justify-between">
                                            <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Reservation</h2>
                                            <div class="ml-3 flex h-7 items-center">
                                                <button type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500"
                                                        @click="showReserv = false">
                                                    <span class="sr-only">Close panel</span>
                                                    <!-- Heroicon name: outline/x -->
                                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-8 overflow-y-auto ">
                                            <div class="flow-root">
                                                {{-- list item cart --}}
                                                <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                    @foreach ($reservasi as $r)
                                                        <li class="flex py-6">
                                                            <div
                                                                class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                                <img src="{{ route('cloud.images', $r->produk->photo) }}"
                                                                     alt="{{ $r->produk->gambar }}"
                                                                     class="h-full w-full object-cover object-center">
                                                            </div>

                                                            <div class="ml-4 flex flex-1 flex-col">
                                                                <div>
                                                                    <div
                                                                        class="flex justify-between text-base font-medium text-gray-900">
                                                                        <h3>
                                                                            <a href="#">{{ $r->produk->nama }} </a>
                                                                        </h3>
                                                                        <p class="ml-4">
                                                                            {{ number_format($r->produk->harga) }}
                                                                        </p>
                                                                    </div>
                                                                    <p class="mt-1 text-xs text-gray-500">{{ $r->deskripsi_reservasi }}</p>
                                                                </div>
                                                                <div
                                                                    class="flex flex-1 items-end justify-between text-sm">
                                                                    <p class="text-gray-500">{{ $r->jadwal_reservasi->tanggal . ' ' . substr($r->jadwal_reservasi->jam, 0, -3) }}
                                                                    </p>

                                                                    <div class="flex">
                                                                        <p class="font-medium">{{ucfirst($r->status_reservasi)}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <p>Subtotal</p>
                                            <p>Rp </p>
                                        </div>
                                        <div class="mt-6">
                                            {{--                    <a href="{{route('checkout')}}"--}}
                                            {{--                       class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>--}}
                                        </div>
                                        <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                            <p>
                                                or <button type="button"
                                                           class="font-medium text-indigo-600 hover:text-indigo-500">Continue
                                                    Shopping<span aria-hidden="true"> &rarr;</span></button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                        {{-- shopping cart --}}
                    </div>
{{--                    <form action="{{ route('logout') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <button type="submit"--}}
{{--                            class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700">Sign--}}
{{--                            out</button>--}}
{{--                    </form>--}}
                    <div class="ml-8" x-data="{showPopupMenu : false}">
                        <a href="#"  @click="showPopupMenu = !showPopupMenu" class="flex items-center mr-4 hover:text-blue-100">

                            <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg">
                            {{Auth::user()->name}}
                        </a>
                        <div class="relative" x-show="showPopupMenu" @click.away="showPopupMenu = false">
                            <div class="absolute z-20 w-full p-3 mt-3 right-1 space-y-2 overflow-hidden transform shadow-lg bg-gradient-to-br from-white to-gray-50 md:w-48 rounded-md ring-1 ring-black ring-opacity-5">
                                <a href="{{route('order-history')}}" class="block px-4 py-2 text-sm text-gray-600 capitalize cursor-pointer hover:bg-blue-800 rounded-xl hover:text-gray-100"> Order History </a>
                                <form action="{{ route('logout') }}" method="post" style="display:inline">
                                    @csrf
                                    <a class="block px-4 py-2 text-sm text-gray-600 capitalize hover:bg-red-600 rounded-xl hover:text-gray-100">
                                        <button type="submit"
                                                >Logout</button>
                                    </a>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    <a href="{{ route('login') }}"
                        class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}"
                        class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        Sign up </a>
                </div>
            @endif

        </div>
    </div>
</div>
