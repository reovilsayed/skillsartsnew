<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoice;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Mail;

class CalculatorController extends Controller
{
    /**
     * show
     *
     * Shows the calculator page
     *
     * @return void
     */
    public function show()
    {
        return view('calculator.show');
    }
    public function store(Request $request)
    {
        $item = $request->all();
        unset($item['_token']);
        unset($item['charge']);
        unset($item['total']);
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'first_name' => auth()->user() ? auth()->user()->name : null,
            'phone' => auth()->user() ? auth()->user()->phone : null,
            'email' => auth()->user() ? auth()->user()->email : null,
            'type' => 1,
            'services' => json_encode($item),
            'total' => $request->total,
            'subtotal' => $request->total,
        ]);
        if (auth()->check()) {

            $mail_data = [
                'subject' => "طلب من موقع مهارات الفن# $order->id",
                'title' => 'تفاصيل الطلب - غير مدفوع',
                'opening_message' => "تم استلام طلبك يرجى إتمام السداد لتأكيد الطلب",
                'button' => [
                    'url' => route('payment', $order),
                    'text' => 'سدد الآن'
                ],
                'footer' => 'شكراَ لثقتكم بنا ونسعد بخدمتكم للتواصل بنا على البريد الإلكتروني : info@skillsarts.com',
            ];

             Mail::send(new OrderNotification($order, $mail_data));
        }
        session::put('order_id', $order->id);
        if ($request->charge) {
            $percentage = (100 * $request->charge) / $request->total;
            $percentage = $percentage >= 100 ? 100 : round($percentage);
            $order->charges()->create([
                'amount' => $request->charge,
                'percentage' => $percentage
            ]);
            return redirect()->route('payment', $order->id);
        }
        return redirect(route('whatsapp'));
    }
}
