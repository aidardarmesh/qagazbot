<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPrinted extends Mailable
{
    use Queueable, SerializesModels;

    public $client_name;

    public $info;

    public function __construct($client_name, $info)
    {

        $this->client_name = $client_name;
        
        $this->info = $info;

    }

    public function build()
    {
        
        return $this->view('mail.printed', [
                                            'info' => $this->info
                                            ])
                    ->from(config('mail.username'), $this->client_name . " распечатал")
                    ->subject($this->info);

    }
}
