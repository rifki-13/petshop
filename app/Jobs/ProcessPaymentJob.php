<?php

namespace App\Jobs;

use App\Events\SendPaymentStatus;
use App\Models\ItemTransaksi;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $response;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        $transaksi = Transaksi::where('nomor', $this->response->order_id)->first();
        if ($this->response->transaction_status === 'cancel') {
            $list_item = ItemTransaksi::where('transaksi_id', $transaksi->id)->get();
            foreach ($list_item as $item) {
                $item->delete();
            }
            $transaksi->status = 'cancelled';
            $transaksi->save();
        } elseif ($this->response->transaction_status === 'pending') {
            $transaksi->status = 'pending';
            $transaksi->save();
        } elseif ($this->response->transaction_status === 'settlement') {
            $transaksi->status = 'lunas';
            $transaksi->save();
            $pembayaran = new Pembayaran();
            $pembayaran->transaksi_id = $transaksi->id;
            $pembayaran->jumlah_bayar = $this->response->gross_amount;
            $pembayaran->metode_bayar = 'transfer';
            $pembayaran->tanggal_pembayaran = $this->response->settlement_time;
            $pembayaran->payment_type = $this->response->payment_type;
            $pembayaran->save();
        } elseif ($this->response->transaction_status === 'expire') {
            $transaksi->status = 'gagal';
            $transaksi->save();
        }

        DB::commit();

        SendPaymentStatus::dispatch($transaksi);
    }
}
