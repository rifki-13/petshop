<?php

namespace App\Http\Controllers;

use App\Models\JadwalReservasi;
use App\Models\User;
use App\Notifications\ReservationResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function index() {
        $startWeek = Carbon::now()->startOfWeek()->toDateString();

//      Menggunakan self join
        $tanggal = JadwalReservasi::with('list_jam:id,jam,tanggal,status_reservasi')->select('tanggal')->whereDate('tanggal', '>=', $startWeek)->groupBy('tanggal')->paginate(7);

//        Manual mapping
//        foreach($tanggal as $tgl)
//        {
//            $jam = JadwalReservasi::select('id', 'jam', 'status_reservasi')->where('tanggal', $tgl->tanggal)->get();
//            $arr = [];
//            foreach($jam as $j) {
//                $foo['id'] = $j->id;
//                $foo['waktu'] = $j->jam;
//                $foo['status'] = $j->status_reservasi;
//                $arr[] = $foo;
//            }
//            $tgl->harian = $arr;
//        }

        $data['jadwal'] = $tanggal;
        $data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $data['status'] = ['open', 'closed', 'booked'];

        return view('reservasi.index', $data);
    }

    public function addDay() {
        $latest = JadwalReservasi::select('tanggal')->orderBy('tanggal', 'desc')->first();
        $tgl = Carbon::parse($latest->tanggal)->addDay()->toDateString();
        $arr = ['09:00', '11:00', '14:00', '16:00'];
        for($i=0;$i<4;$i++){
            $day = new JadwalReservasi();
            $day->tanggal = $tgl;
            $day->jam = $arr[$i];
            $day->save();

        }
        return redirect()->back();
    }
    public function addWeek() {
        $latest = JadwalReservasi::select('tanggal')->orderBy('tanggal', 'desc')->first();
        $tanggal = Carbon::parse($latest->tanggal)->addDay();
        $arr = ['09:00', '11:00', '14:00', '16:00'];
        for($i=0;$i<7;$i++){
            $tgl = $tanggal->copy()->addDays($i);
            for($j=0;$j<4;$j++){
                $day = new JadwalReservasi();
                $day->tanggal = $tgl;
                $day->jam = $arr[$j];
                $day->save();
            }
        }
        return redirect()->action([ReservasiController::class, 'index']);
    }

    public function changeStatus(Request $request) {
//        dd($request);die;
        $page = $request->page;
        $list_id = json_decode( html_entity_decode( stripslashes ($request->changed_id ) ) );
        foreach($list_id as $id){
            $time = JadwalReservasi::find($id);
            if($time->status_reservasi == 'open'){
                $time->status_reservasi = 'closed';
            } elseif($time->status_reservasi == 'closed') $time->status_reservasi = 'open';
            $time->save();
        }
        return redirect()->action([ReservasiController::class, 'index'], ['page'=>$page]);
    }

    public function listReservasi(){
        $reservasi = Reservasi::with('jadwal_reservasi')
                                ->with('user')
                                ->with('produk')
                                ->get();
        $data['reservasi'] = $reservasi->filter(function ($reservasi) {
            if($reservasi->jadwal_reservasi->tanggal >= Carbon::now())
                return $reservasi;
        });
        $data['status'] = ['declined', 'approved'];
        return view('reservasi.list_reservasi', $data);
    }

    public function changeReservationStatus(Request $request) {
        $list_id = json_decode( html_entity_decode( stripslashes ($request->changedId ) ) );
        foreach($list_id as $id){
            $reservasi = Reservasi::find($id->id);
            $reservasi->status_reservasi = $id->status;
            if($id->status === 'approved'){
                $jadwal = JadwalReservasi::find($reservasi->tanggal_reservasi);
                $jadwal->status_reservasi = 'booked';
                $jadwal->reservasi_id = $reservasi->id;
                $jadwal->save();
            }
            $reservasi->save();

            $user = User::find($reservasi->user_id);
            $user->notify(new ReservationResponse($user, $reservasi));
        }
        return redirect()->action([ReservasiController::class, 'index']);
    }
}
