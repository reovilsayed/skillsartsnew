<?php

declare(strict_types=1);

namespace App\Traits;

use App\Mail\OrderInvoice;
use App\Order;
use Illuminate\Support\Facades\Mail;

trait AssignUser
{

    /**
     * Assign logged in user to order if order_id exists in session
     *
     * @return void
     */
    public function assignUserToOrder($user = null)
    {
        if(auth()->check()){
            $user = auth()->user();
        }
        if(session()->has('order_id')){
            $order = Order::find(session()->get('order_id'));
            $order->update([
                'user_id'=>$user->id,
                'first_name'=>$user->name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
            ]);
            $after_update_order = Order::find(session()->get('order_id'));
           Mail::send(new OrderInvoice($after_update_order));
           session()->forget('order_id');
        }
        return ;
    }
}
