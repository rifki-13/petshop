<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendPaymentStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transaksi;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function broadcastAs()
    {
        return 'app.payment-status';
    }
    /**
     * Broadcast this data
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'status' => $this->transaksi->status,
            'id' => $this->transaksi->user_id,
            'order_id' => $this->transaksi->nomor,
        ];
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('payment-status-'.$this->transaksi->user_id);
    }
}
