<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Mail\OrderConfirmed;
use Illuminate\Http\Request;
use App\Order;
use Shop;
use Cart;
use App\OrderProduct;
use App\Product;
use App\Mail\OrderPlaced;
use App\Mail\NotificationEmail;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Models\User;
use App\Payment\Areeba;

class CheckoutController extends Controller
{

    public function payment(Order $order)
    {

        if ($order->type == 0 && $order->status == 1) return redirect()->route('invoice', $order);

        $session = (new Areeba)->purchase();
        if ($order->status == 0) {
            $order->update([
                'payment_id' => $session['order']['uniqid']
            ]);
        }
        return view('payment', compact('order', 'session'));
    }
    public function store(Request $request)
    {
        if (Cart::isEmpty()) {
            return redirect('/shop');
        }
        session()->put('custom_discount',$request->custom_discount);
        $request->validate([
            'first_name' => ['required', 'max:40'],
            'last_name' => ['nullable', 'max:40'],
            'email' => ['nullable', 'max:40', 'email'],
            'address' => ['nullable', 'max:200'],
            'phone' => ['required', 'max:15'],
            'company_name' => ['nullable', 'max:15'],
        ]);
        if($request->user_id){
            $user_id = $request->user_id;
        }else{
            $user_id = auth()->user()->id;
        }
        $order = Order::create([
            'user_id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company_name' => $request->company_name,
            'subtotal' => Shop::round_num(Cart::getSubTotal()),
            'discount' => Shop::round_num(Shop::discount()),
            'discount_code' => Shop::discount_code(),
            'tax' => Shop::round_num(Shop::tax()),
            'shipping_cost' => Shop::round_num(Shop::shipping()),
            'shipping_method' => Shop::shipping_method(),
            'total' => Shop::round_num(Shop::newTotal()),
        ]);

        foreach (Cart::getContent() as $item) {
            $variations =  json_encode($item->model->variation);
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'variation' => $variations,
            ]);
        }

        Cart::clear();
        session()->forget('discount');
        session()->forget('discount_code');

        $mail_data = [
            'subject' => "طلب من موقع مهارات الفن# $order->id",
            'title' => 'عرض سعر من موقع مهارات الفن',
            'opening_message' => "تم استلام طلبك وهذا عرض سعر يرجى إتمام السداد لتأكيد موافقتك على الطلب",
            'button' => [
                'url' => route('payment', $order),
                'text' => 'سدد الآن'
            ],
            'footer' => 'شكراَ لثقتكم بنا ونسعد بخدمتكم للتواصل بنا على البريد الإلكتروني : info@skillsarts.com',
        ];

        Mail::send(new OrderNotification($order, $mail_data));
        return redirect(route('payment', $order));
    }
}
