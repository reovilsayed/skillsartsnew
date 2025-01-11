@component('mail::message')
    @php
        $locale = $order->locale == 'en';
    @endphp
    <h1 class="title">Payment Request #{{ $order->id }}</h1>
    <div class="body-section" @if($locale) style="text-align: left" @endif>
        {{ $locale ? 'Hello,' : 'السلام عليكم' }} {{ $order->first_name }} {{ $order->last_name }} <br>
        {{ $locale ? 'A new payment request was sent for the request made on the date' : 'طلب سداد جديد ارسل للطلب الذي تم في تاريخ ' }}{{ $order->created_at->format('M d, Y') }}
        <br />
        {{ $locale ? 'Find below the order details' : 'تجد ادناه تفاصيل الطلب' }}
        <table class="order-details" @if($locale) style="direction: ltr" @endif>
            <tr>
                <th @if($locale) style="text-align: center" @endif>#{{ $locale ? 'Number' : 'الرقم' }}</th>
                <th @if($locale) style="text-align: center" @endif>{{ $locale ? 'Value' : 'القيمة' }}</th>
                <th @if($locale) style="text-align: center" @endif>{{ $locale ? 'Invoice date' : 'تاريخ الفاتورة' }}</th>
                <th @if($locale) style="text-align: center" @endif>{{ $locale ? 'Condition' : 'الحالة' }}</th>
            </tr>
            @foreach ($order->charges as $charge)
                <tr>
                    <td @if($locale) style="text-align: center" @endif>{{ $charge->id }}</td>
                    <td @if($locale) style="text-align: center" @endif>{{ Shop::price($charge->amount) }} </td>
                    <td @if($locale) style="text-align: center" @endif>{{ $charge->created_at->format('d-m-Y') }} </td>
                    <td @if($locale) style="text-align: center" @endif> <button
                            class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                        @if ($charge->status == 0)
                            <a href="{{ route('payment', $order->id) }}"
                                class="btn btn-success">{{ $locale ? 'Pay now' : 'أدفع الآن' }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table> <br>
        <table class="order-details" @if($locale) style="direction:ltr" @endif>
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Totle' : 'المجموع' }}</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Tax' : 'الضريبة' }}</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Opponent' : 'الخصم' }}</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Final total' : 'المجموع النهائي' }}</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        <h2 class="heading" @if($locale) style="text-align: left" @endif>{{ $locale ? 'Title' : 'العنوان' }}</h2>
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
            Show Details
        @endcomponent
        {{ $locale ? 'Thank you again for using the Skills Arts website' : 'شكراً مرة أخرى لإستخدامكم موقع سكيلز آرتس' }}
        Regards,<br>
        {{ config('app.name') }}
    </div>
@endcomponent
