<?php

namespace App\Sms;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;
class Message
{

    public function __construct(string $phone,String $message = '')
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    public function send()
    {
        // $this->client->messages->create(
        //     '+'.$this->phone,
        //     array(
        //         'from' => env('TWILIO_FROM'),
        //         'body' => $this->message,
        //     )
        // );
    }
}
