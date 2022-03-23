@extends('layouts.admin')
@section('contents')
    <div
        class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded"
        x-data="{changedId: []}">
        <div class="rounded-t mb-0 px-0 border-0">
            <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Daftar Reservasi</h3>
                </div>
                <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                    <a class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                       type="button" href="{{ route('reservasi.index') }}">Jadwal Reservasi</a>
                    <form action="{{route('reservasi.res')}}" method="post" style="display:inline">
                        @csrf
                        <input type="hidden" :value="JSON.stringify(changedId)" name="changedId">
                        <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                           type="submit">Save Changes</button>
                    </form>

                </div>
            </div>
            <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Nama</th>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Email</th>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Jenis Reservasi</th>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Deskripsi</th>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Tanggal</th>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Jam</th>
                        <th
                            class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reservasi as $res)
                        <tr class="text-gray-700 dark:text-gray-100">
                            <th
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                {{ $res->user->name }}</th>
                            <td
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $res->user->email }}</td>
                            <td
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $res->produk->nama }}</td>
                            <td
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $res->deskripsi_reservasi }}</td>
                            <td
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $res->jadwal_reservasi->tanggal }}</td>
                            <td
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $res->jadwal_reservasi->jam }}</td>
                            <td
                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                x-data="{def: '{{$res->status_reservasi}}',
                                         cborder: '',
                                         selected: '',
                                         changed(id){
                                            if(this.selected !== this.def){
                                                this.cborder = 'dark:border-green-500';
                                                let exist = false;
                                                for(let i of this.changedId){
                                                    if(i.id === id){
                                                        exist = true;
                                                        break;
                                                    }
                                                }
                                                let arr = {id: id, status: this.selected};
                                                if(exist) {
                                                    let index = this.changedId.findIndex(element => {
                                                        if(element.id === id)
                                                            return true;
                                                    });
                                                    this.changedId.splice(index, 1, arr);
                                                }
                                                else {
                                                    this.changedId.push(arr);
                                                }
                                            } else {
                                                this.cborder = '';
                                                let index = this.changedId.findIndex(element => {
                                                    if(element.id === id)
                                                        return true;
                                                });
                                                this.changedId.splice(index, 1);
                                            }
                                            console.log(JSON.stringify(this.changedId));
                                         }
                                        }"
                            >
                                <select
                                    class="w-24 py-2 mr-0 px-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none"
                                    x-model="selected"
                                    @change="changed({{$res->id}})"
                                    :class="cborder"
                                    @if($res->status_reservasi !== 'pending') disabled @endif
                                >
                                    <option value="{{$res->status_reservasi}}">{{ucfirst($res->status_reservasi)}}</option>
                                    @foreach($status as $s)
                                        <option value="{{$s}}">{{ucfirst(substr($s, 0,-1))}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                {!! $produk->links() !!}--}}
            </div>
        </div>
    </div>
<script type="text/javascript">
    window.onbeforeunload = function() {
        let isChange = false;
        document.querySelectorAll('[x-data]').forEach(el => {
            if(el.__x.getUnobservedData().hasOwnProperty('changedId'))
                if(el.__x.getUnobservedData().changedId.length > 0)
                    isChange = true;
        });
        if(isChange)
            return "Save Changes?";
    }
</script>
@endsection
