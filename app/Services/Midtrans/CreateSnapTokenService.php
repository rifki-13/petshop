<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $item_details = [];
        foreach($this->order['item_details'] as $detail){
            $item['id'] = $detail['produk_id'];
            $item['price'] = $detail['harga'];
            $item['quantity'] = $detail['jumlah'];
            $item['name'] = $detail['nama'];
            $item_details[] = $item;
        }
        $params = [
            'transaction_details' => [
                'order_id' => $this->order['nomor'],
                'gross_amount' => $this->order['total'],
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
