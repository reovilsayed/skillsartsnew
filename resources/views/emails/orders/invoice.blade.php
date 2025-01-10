@component('mail::message')
{{-- @dd($order) --}}
    @php
        $locale = $order->locale == 'en';
    @endphp
    <h1 class="title" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'السلام عليكم هذه فاتورة لطلبكم من موقع سكيلز آرتس' : 'Peace be upon you. This is an invoice for your order from the Skills Arts website'}}#{{ $order->id }}</h1>
    <div class="body-section" @if($locale) style="direction: ltr" @endif>
        {{ $order->locale == 'ar' ? 'رقم الطلب' : 'Order number :'}} {{ $order->id }}<br />
        @if ($order->type == 0)
            <table class="order-details">
                <tr>
                    <th @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'الخدمة' : 'Service'}}</th>
                    <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'ar' ? 'الكمية' : 'Quantity'}}</th>
                    <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'ar' ? 'السعر' : 'Price' }}</th>
                </tr>
                @foreach ($order->products as $product)
                    <tr>
                        <td @if($locale) style="text-align: left" @endif>{{ $product->name }}</td>
                        <td @if($locale) style="text-align: center" @endif>{{ $product->pivot->quantity }} </td>
                        <td @if($locale) style="text-align: center" @endif>{{ Shop::price($product->price) }} </td>
                    </tr>
                @endforeach
            </table> <br />
        @else
            <table class="order-details">
                <thead>
                    <tr role="row">
                        <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0" @if($locale) style="text-align: center" @endif>
                            {{ $order->locale == 'ar' ? 'الخدمة' : 'Service'}}
                        </th>
                        <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0"  @if($locale) style="text-align: center" @endif>
                            {{ $order->locale == 'ar' ? 'تفاصيل' : 'Details' }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($order->services) as $name => $details)
                        <tr>
                            <td>
                                {{ ucfirst($name) }}
                            </td>
                            <td>
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
                    @endforeach
                </tbody>
            </table>
            @if ($order->charges->count() > 0)
                <table class="order-details">
                    <tr>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'ar' ? 'الرمز' : 'Symbol' }}</th>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'ar' ? 'القيمة' : 'Value' }}</th>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'ar' ? 'تاريخ الفاتورة' : 'Invoice date' }}</th>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'ar' ? 'الحالة' : 'Condition' }}</th>
                    </tr>
                    @foreach ($order->charges as $charge)
                        <tr>
                            <td @if($locale) style="text-align: center" @endif>{{ $charge->id }}</td>
                            <td @if($locale) style="text-align: center" @endif>{{ Shop::price($charge->amount) }} </td>
                            <td @if($locale) style="text-align: center" @endif>{{ $charge->created_at->format('d-m-Y') }} </td>
                            <td> <button
                                    class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                                @if ($charge->status == 0)
                                    <a href="{{ route('payment', $order->id) }}" @if($locale) style="text-align: center" @endif class="btn btn-success">{{ $order->locale == 'ar' ? 'أدفع الآن' : 'Pay now' }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif
        <table class="order-details">
            <tr>
                <td class="font-weight-bold"  @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'إجمالي السلة' : 'Total basket'}}</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            @if ($order->tax > 0)
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'المجموع' : 'Total'}}</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'الخصم' : 'Opponent'}}</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'المجموع' : 'Total'}}</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        <h2 class="heading" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'ar' ? 'بيانات صاحب الطلب' : 'Data of the applicant'}}</h2>
        <div class="border">
            {{ $order->first_name }} {{ $order->last_name }} <br />
            {{ $order->phone }} <br />
            {{ $order->email }} <br />
            {{ $order->address }} <br />
        </div>
        @php $url = route('orders'); @endphp
        @component('mail::button', ['url' => $url, 'color' => 'green'])
        {{ $order->locale == 'ar' ? 'عرض الطلب' : 'View the order'}}
        @endcomponent
        {{ $order->locale == 'ar' ? 'تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.
        مع تحيات فريق سكيلز آرتس' : 'Need help? Do not hesitate to contact us by replying to this message.
        Greetings from the Skills Arts team'}}
        <br>
		https://skillsarts.com<br>
        {{ config('app.name') }}
    </div>
@endcomponent
