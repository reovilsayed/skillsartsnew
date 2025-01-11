
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة للطلب</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333333;
        }

        .email-container {
            max-width: 800PX;
            margin: 30px auto;
            background-color: #ffffff;
            border: 1px solid #e3e3e3;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #96588a;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            margin: 0px 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .body-section {
            padding: 20px;
            line-height: 1.8;
            font-size: 16px;
        }

        .order-details {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .order-details th,
        .order-details td {
            border: 1px solid #e3e3e3;
            padding: 12px;
            text-align: center;
        }

        .cta-button {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 6px 15px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            margin: 20px 0;
        }

        .cta-button:hover {
            background-color: #218838;
        }

        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #6c757d;
        }

        .footer a {
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .customer-info {
            border: 1px solid #e3e3e3;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }

        .customer-info div {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    @php
        $locale = $order->locale == 'en';
    @endphp
    {{-- @dd($locale) --}}
    <div class="email-container" @if ($locale) style="text-align: left" @endif>
        <h1 class="title" @if ($locale) style="text-align: left" @endif>
            {{ $order->locale == 'en' ? 'Invoice for the order' : 'فاتورة للطلب'}} #{{ $order->id }}
        </h1>
        <div class="body-section" @if ($locale) style="text-align " @endif>
            {{ $order->locale == 'en' ? 'Hello,' : 'السلام عليكم' }} {{ $order->first_name }} {{ $order->last_name }}
            <br>
            {{ $order->locale == 'en' ? 'The request was made in' : 'الطلب الذي تم في'}}
            {{ $order->created_at->format('M d, Y') }}
            {{ $order->locale == 'en' ? 'It has been confirmed' : 'تم تأكيده'}}<br />
            <table class="order-details"  @if($locale) style="direction: ltr" @endif>
                <thead>
                    <tr role="row">
                        <th class="sorting" colspan="1" rowspan="1" tabindex="0" @if ($locale) style="text-align: center" @endif>
                            {{ $order->locale == 'en' ? 'Service' : 'الخدمة'}}
                        </th>
                        <th class="sorting" colspan="1" rowspan="1" tabindex="0" @if ($locale) style="text-align: center" @endif>
                            {{$order->locale == 'en' ? 'Details' : 'تفاصيل'}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach (json_decode($order->services) as $name => $details)
                    <tr>
                        <td @if ($locale) style="text-align: center" @endif>
                            {{ ucfirst($name) }}
                        </td>
                        <td @if ($locale) style="text-align: center" @endif>
                            <ul>
                                @foreach ($details as $name => $value)
                                    <li>
                                        {{ ucfirst($name) }} :
                                        {{ json_encode($value) }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach --}}
                </tbody>
            </table>
            <table class="order-details" @if($locale) style="direction: ltr" @endif>
                <tr>
                    <th @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Symbol' : 'الرمز'}}</th>
                    <th @if ($locale) style="text-align: center" @endif>{{$order->locale == 'en' ? 'Value' : 'القيمة'}}</th>
                    <th @if ($locale) style="text-align: center" @endif>{{$order->locale == 'en' ? 'Invoice date' : 'تاريخ الفاتورة'}}</th>
                    <th @if ($locale) style="text-align: center" @endif>{{$order->locale == 'en' ? 'Condition' : 'الحالة'}}</th>
                </tr>
                @foreach ($order->charges as $charge)
                    <tr>
                        <td @if ($locale) style="text-align: left" @endif>{{ $charge->id }}</td>
                        <td @if ($locale) style="text-align: center" @endif>{{ Shop::price($charge->amount) }} </td>
                        <td @if ($locale) style="text-align: center" @endif>{{ $charge->created_at->format('d-m-Y') }} </td>
                        <td @if ($locale) style="text-align: center" @endif> <button
                                class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                            @if ($charge->status == 0)
                                <a href="{{ route('payment', $order->id) }}" class="btn btn-success">{{$order->locale == 'en' ? 'Pay now' : 'أدفع الآن'}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <table class="order-details" @if($locale) style="direction: ltr" @endif>
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Total basket' : 'إجمالي السلة'}}</td>
                    <td>{{ Shop::price($order->subtotal) }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Tax' : 'الضريبة'}}</td>
                    <td>{{ Shop::price($order->tax) }}</td>
                </tr>
                @if ($order->shipping_cost > 0)
                    <tr>
                        <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Shipping value' : 'قيمة الشحن'}}</td>
                        <td>{{ Shop::price($order->shipping_cost) }}</td>
                    </tr>
                @endif
                @if ($order->discount > 0)
                    <tr>
                        <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Opponent' : 'الخصم'}}</td>
                        <td>{{ Shop::price($order->discount) }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Total' : 'المجموع'}}</td>
                    <td>{{ Shop::price($order->total) }}</td>
                </tr>
            </table>
            <h2 class="heading" @if ($locale) style="text-align: left" @endif>{{$order->locale == 'en' ? 'Customer data' : 'بيانات العميل'}}</h2>
            <div class="border">
                {{ $order->first_name }} {{ $order->last_name }} <br />
                {{ $order->phone }} <br />
                {{ $order->address }} <br />
                {{ $order->city }} <br />
                {{ $order->post_code }} <br />
                {{ $order->state }} <br />
            </div>
            @php $url = route('orders'); @endphp
            @component('mail::button', ['url' => $url, 'color' => 'green'])
                {{$order->locale == 'en' ? 'View order' : 'عرض الطلب'}}
            @endcomponent
            {{$order->locale == 'en' ? 'Need help? Do not hesitate to contact us by replying to this message.
            Greetings from the Skills Arts team' : 'تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.
            مع تحيات فريق سكيلز آرتس'}}<br>
            https://skillsarts.com<br>
            {{ config('app.name') }}
        </div>
    </div>
</body>

</html>
