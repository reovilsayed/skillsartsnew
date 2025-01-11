<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $order;
    public $locale;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $data, $locale)
    {
        $this->data = (object) $data;
        $this->order = $order;
        $this->locale = $locale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->email, $this->order->first_name)
            ->bcc(setting('site.email'))
            ->subject($this->data->subject)
            ->markdown('emails.orders.notification');
    }
}
