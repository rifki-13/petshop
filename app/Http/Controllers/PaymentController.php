<?php

namespace App\Http\Controllers;

use App\Events\SendPaymentStatus;
use App\Jobs\ProcessCheckoutJob;
use App\Jobs\ProcessPaymentJob;
use App\Models\Cart;
use App\Models\ItemTransaksi;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\Midtrans;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        ProcessCheckoutJob::dispatch($request);

        return redirect()->action([StoreController::class, 'index']);

    }

    public function notification()
    {
        $midtrans = new Midtrans();
        $notif = new Notification();
        $response = $notif->getResponse();

        ProcessPaymentJob::dispatch($response);

        return response()->json(['success' => 'success'], 200);
    }

    public function ongoingPayment()
    {
        $trans = Transaksi::with('itemTransaksi.produk.kategori')
            ->where([['user_id', Auth::user()->id], ['snap_token', '!=', null], ['status', ['belum bayar', 'pending']]])
            ->orderBy('id', 'desc')
            ->paginate(10);
        $data['transaksi'] = $trans;
        return view('public.ongoing-payment', $data);
    }

    public function cancelPayment(Request $request)
    {
        $order_id = $request->order_id;
        $client = new Client();
        $url = "https://api.sandbox.midtrans.com/v2/" . $order_id . "/cancel";
        $headers = ["Authorization" => "Basic SB-Mid-server-t013aom0ikZ5anU-god2252Q:"];
        $response = $client->request('POST', $url, ["headers" => $headers]);

        return redirect()->to(route('ongoing-payment'));
    }
}
