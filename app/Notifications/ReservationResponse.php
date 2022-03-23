<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationResponse extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $reservasi)
    {
        $this->user = $user;
        $this->reservasi = $reservasi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Pemberitahuan Reservasi Petshop')
                    ->greeting('Hi '. $this->user->name. ',')
                    ->line('Reservasi Petshop untuk '. $this->reservasi->deskripsi_reservasi . ' telah di konfirmasi. Silahkan datang ke Petshop pada TANGGAL yang telah di tentukan')
                    ->line('Terima kasih telah menggunakan website untuk membuat reservasi');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
