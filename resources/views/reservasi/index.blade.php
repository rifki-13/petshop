@extends('layouts.admin')
@section('contents')
<div id="div_root"
    class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded" x-data="{changed_id: [], changed(id) {this.changed_id.push(id)}}">
    <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
            <div class="relative w-full max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-xl text-gray-900 dark:text-gray-50">Reservation Schedule This Week</h3>
            </div>
            <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                <a href="{{route('reservasi.daftar')}}" type="button" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Daftar Reservasi</a>
                <form action="{{route('reservasi.changeStatus')}}" method="post" style="display:inline" id="form_save">
                    @csrf
                    <input name="page" type="hidden" value="{{app()->request->get('page')}}">
                    <input type="hidden" id="changed_id" name="changed_id" :value="JSON.stringify(changed_id)">
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
                        Hari</th>
                    <th
                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Tanggal</th>
                    <th
                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        09:00</th>
                    <th
                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        11:00</th>
                    <th
                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        14:00</th>
                    <th
                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        16:00</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($jadwal as $key=>$sch)
                    <tr class="text-gray-700 dark:text-gray-100">
                        <th
                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{$hari[$key]}}</th>
                        <th
                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{$sch->tanggal}}</th>
                        @foreach($sch->list_jam as $daily)
                            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <select id="status" name="status" class="w-auto p-1 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none"
                                    :class="'{{$daily->status_reservasi}}' === 'booked' ? 'dark:border-green-700' : ('{{$daily->status_reservasi}}' === 'closed' ? 'dark:border-red-500' : 'dark:border-blue-300')"
                                    @change="changed({{$daily->id}})"
                                    @if($daily->status_reservasi === 'booked') disabled @endif
                                >
                                        @foreach($status as $s)
                                            <option value="{{$s}}"
                                                    @if($s === $daily->status_reservasi)
                                                        selected
                                                    @endif

                                            >{{ucfirst($s)}}</option>
                                        @endforeach
                                </select>
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $jadwal->links() !!}
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#form_save').submit(function() {
       window.onbeforeunload = null;
        return true;
    })
    window.onbeforeunload = function() {
        if(document.getElementById('div_root').__x.$data.changed_id.length > 0 ){
            return confirm('save changes');
        } else return null;
    }
</script>
@endsection
