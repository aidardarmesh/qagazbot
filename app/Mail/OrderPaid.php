<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPaid extends Mailable
{
    use Queueable, SerializesModels;

    public $client_name;

    public $order_id;

    public function __construct($client_name, $order_id)
    {
        
        $this->client_name = $client_name;

        $this->order_id = $order_id;

    }

    public function build()
    {
        
        return $this->view('mail.paid', [
                                            'url' => url('/orders/' . $this->order_id)
                                            ])
                    ->from(config('mail.username'), $this->client_name . " оплатил")
                    ->subject($this->client_name . " оплатил");

    }
}
