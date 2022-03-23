<div class="fixed overflow-auto right-0 bottom-0 top-0 left-0 flex items-center justify-center w-full h-full"
    style="background-color: rgba(0,0,0,.5);" x-show="openModal" x-data="{deskripsi: ''}">
    <!-- A basic modal dialog with title, body and one button to close -->
    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-2xl md:p-6 lg:p-8 md:mx-0 z-10"
        @click.away="openModal = false, jumlah=1">
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Produk Detail</h3>
            <div class="mt-2">
                <section class="text-gray-700 body-font overflow-hidden bg-white">
                    <div class="container px-5 py-5 mx-auto">
                        <div class="lg:w-4/5 mx-auto flex flex-wrap">
                            <img class="lg:w-1/2 w-full object-fit object-center rounded border border-gray-200 "
                                :src="imgUrl">
                            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                <h2 class="text-sm title-font text-gray-500 tracking-widest" x-text="kategori"></h2>
                                <h1 class="text-gray-900 text-3xl text-justify font-medium mb-1" x-text="product.nama">
                                </h1>
                                <p class="leading-relaxed" x-text="product.deskripsi"></p>
                                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-2">
                                </div>
                                <div>
                                    <span class="title-font font-medium text-lg text-gray-500" x-text="product.stok > 0 ? 'Stok: ' + product.stok : ''"
                                        ></span>
                                    <template x-if="product.jenis === 'jasa'">
                                        <textarea x-model="deskripsi" name="deskripsi" rows="3" style="resize:none;" class="border border-solid border-1 p-1"></textarea>
                                    </template>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="mt-5 sm:mt-6">
            <span class="flex w-full rounded-md shadow-sm">
                <button @click="openModal=false, jumlah = 1"
                    class="flex ml-0 text-white bg-blue-500 hover:bg-blue-600 rounded py-2 px-6 ">
                    Close
                </button>

                @if (Auth::check())
                    <template x-if="product.jenis === 'produk'">
                        <form :action="cartUrl" method="post" class="flex ml-6 items-center" id="formCart">
                            @csrf
                            <input type="hidden" name="produk_id" id="produk_id" :value="product.id">
                            <input type="hidden" name="harga" id="harga" :value="product.harga">
                            <span class="mr-3">Jumlah</span>
                            <div class="relative">
                                <input type="number" name="jumlah" id="jumlah" min='1' :max="product.stok"
                                    class="w-1/2 px-4 py-2 text-base border border-gray-300 rounded outline-none"
                                    x-model="jumlah">
                            </div>
                            <button
                                class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>Add to Cart
                            </button>
                        </form>
                    </template>
                    <template x-if="product.jenis === 'jasa'"
                              x-data="{tanggal:'', open: {{json_encode($tgl_reservasi->toArray())}}, slcIndex: ''}">
                        <form action="{{route('reservasi.add')}}" method="post" class="flex ml-6 items-center">
                            @csrf
                            <input name="deskripsi" :value="deskripsi" type="hidden">
                            <input name="produk_id" :value="product.id" type="hidden">
                            <span class="mr-3">Tanggal</span>
                            <div class="relative items-start">
                                <input
                                    type="date"
                                    min="{{\Carbon\Carbon::now()->toDateString()}}"
                                    max="{{$tgl_reservasi->last()->tanggal}}"
                                    name="tanggal"
                                    class="w-auto px-4 py-2 text-base border border-gray-300 rounded outline-none"
                                    x-model="tanggal"
                                    @change="slcIndex = open.findIndex((object) => object.tanggal === tanggal)">
                                <template x-if="tanggal">
                                    <select class="w-16 py-2" name="jam">
                                        <template x-for="jam in open[slcIndex].list_jam">
                                            <option :value="jam.id" x-text="(jam.jam).substring(0,5)" class="w-16"></option>
                                        </template>
                                    </select>
                                </template>
                            </div>
                            <button
                                class="flex ml-12 text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>Reservasi
                            </button>
                        </form>
                    </template>
                @endif
            </span>
        </div>
    </div>
</div>
