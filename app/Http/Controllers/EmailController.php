<?php

namespace App\Http\Controllers;

use App\Mail\OrderNotificationPrint;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function printInvoice(Order $order)
    {
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

        return new OrderNotificationPrint($order, $mail_data);
    }
}
