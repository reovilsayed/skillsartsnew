<?php

namespace App\Payment;

use App\Order;
use Illuminate\Support\Facades\Http;
use Shop;
class Areeba
{

    public function __construct()
    {
        $this->user_id      = config('areeba.user_id');
        $this->password     = config('areeba.password');
        $this->currency     = config('areeba.currency');
    }

    public function purchase()
    {
        $id = uniqid();
        $data = [
            "apiOperation" => "CREATE_CHECKOUT_SESSION",
            "interaction" => [
                "operation" => "PURCHASE"
            ],
            "order" => [
                "currency" => $this->currency,
                "id" => $id,
                "amount" => Shop::round_num(request()->order->bill()/3.75)
            ]
        ];

        $payment= Http::withBasicAuth("merchant.".$this->user_id, $this->password)->post("https://epayment.areeba.com/api/rest/version/60/merchant/".$this->user_id."/session", $data);
        $response = json_decode($payment->body());

        return [
            'response' => $response,
            'order' => ['id'=>request()->order->id,'uniqid'=>$id]
        ];
    }

    public function orderStatus($id){
        $order = Order::find($id);
        $order_status = Http::withBasicAuth("merchant.".$this->user_id, $this->password)->get("https://epayment.areeba.com/api/rest/version/60/merchant/".$this->user_id."/order/".$order->payment_id);
       return json_decode($order_status->body());
    }
}
