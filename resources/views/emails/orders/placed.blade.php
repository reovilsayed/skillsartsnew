@component('mail::message')
    @php
        $locale = $order->locale == 'en';
    @endphp
    <h1 class="title" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Invoice for order no' : 'فاتورة للطلب رقم '}}#{{ $order->id }}</h1>
    <div class="body-section" @if($locale) style="direction: ltr" @endif>
        {{ $locale ? 'Hello,' : 'السلام عليكم '}}{{ $order->first_name }} {{ $order->last_name }} <br>
         {{ $locale ? 'Here are the details of your order placed on' : 'ها هي تفاصيل طلبك الذي تم في تاريخ'}}{{ $order->created_at->format('M d, Y') }} <br />
        {{ $locale ? 'Please Pay Now To confirm the order click the Pay Now button' : 'يرجى الدفع الآن لتأكيد الطلب اضغط فوق زر ادفع الآن'}}
        <table class="order-details">
            <tr>
                <th @if($locale) style="text-align: center" @endif>{{ $locale ? 'Service' : 'الخدمة'}}</th>
                <th @if($locale) style="text-align: center" @endif>{{ $locale ? 'Quantity' : 'الكمية'}}</th>
                <th @if($locale) style="text-align: center" @endif>{{ $locale ? 'Price' : 'السعر'}}</th>
            </tr>
            @foreach ($order->products as $product)
                <tr>
                    <td @if($locale) style="text-align: center" @endif>{{ $product->name }}</td>
                    <td @if($locale) style="text-align: center" @endif>{{ $product->pivot->quantity }} </td>
                    <td @if($locale) style="text-align: center" @endif>{{ Shop::price($product->pivot->price) }} </td>
                </tr>
            @endforeach
        </table> <br />
        <table class="order-details">
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Totle' : 'المجموع'}}</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Tax' : 'الضريبة'}}</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @if ($order->shipping_cost > 0)
                <tr>
                    <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Shipping cost' : 'تكلفة الشحن'}}</td>
                    <td>{{ Shop::price($order->shipping_cost) }}</td>
                </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Opponent' : 'الخصم'}}</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Final total' : 'المجموع النهائي'}}</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        <h2 class="heading" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Customer data' : 'بيانات العميل '}}</h2>
        <div class="border">
            {{ $order->first_name }} {{ $order->last_name }} <br />
            {{ $order->phone }} <br />
            {{ $order->address }} <br />
            {{ $order->city }} <br />
            {{ $order->post_code }} <br />
            {{ $order->state }} <br />
        </div>
        @php $url = route('payment',$order); @endphp
        @component('mail::button', ['url' => $url, 'color' => 'green'])
            {{$locale ? 'Pay now' : 'ادفع الآن'}}        @endcomponent
        {{ $locale ? 'Need help? Do not hesitate to contact us by replying to this message.' : 'تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.'}}<br>
        {{ $locale ? 'Greetings from the Skills Arts team' : 'مع تحيات فريق سكيلز آرتس'}}<br>
        https://skillsarts.com<br>
        {{ config('app.name') }}
    </div>
@endcomponent
