@component('mail::message')
{{-- @dd($order) --}}
    @php
        $locale = $order->locale == 'en';
    @endphp
    <h1 class="title" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Peace be upon you. This is an invoice for your order from the Skills Arts website' : 'السلام عليكم هذه فاتورة لطلبكم من موقع سكيلز آرتس'}}#{{ $order->id }}</h1>
    <div class="body-section" @if($locale) style="direction: ltr" @endif>
        {{ $order->locale == 'en' ? 'Order number :' : 'رقم الطلب'}} {{ $order->id }}<br />
        @if ($order->type == 0)
            <table class="order-details">
                <tr>
                    <th @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Service' : 'الخدمة'}}</th>
                    <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'en' ? 'Quantity' : 'الكمية'}}</th>
                    <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'en' ? 'Price' : 'السعر'}}</th>
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
                            {{ $order->locale == 'en' ? 'Service' : 'الخدمة'}}
                        </th>
                        <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0"  @if($locale) style="text-align: center" @endif>
                            {{ $order->locale == 'en' ? 'Details' : 'تفاصيل'}}
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
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'en' ? 'Symbol' : 'الرمز'}}</th>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'en' ? 'Value' : 'القيمة'}}</th>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'en' ? 'Invoice date' : 'تاريخ الفاتورة'}}</th>
                        <th @if($locale) style="text-align: center" @endif>{{ $order->locale == 'en' ? 'Condition' : 'الحالة'}}</th>
                    </tr>
                    @foreach ($order->charges as $charge)
                        <tr>
                            <td @if($locale) style="text-align: center" @endif>{{ $charge->id }}</td>
                            <td @if($locale) style="text-align: center" @endif>{{ Shop::price($charge->amount) }} </td>
                            <td @if($locale) style="text-align: center" @endif>{{ $charge->created_at->format('d-m-Y') }} </td>
                            <td> <button
                                    class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                                @if ($charge->status == 0)
                                    <a href="{{ route('payment', $order->id) }}" @if($locale) style="text-align: center" @endif class="btn btn-success">{{ $order->locale == 'en' ? 'Pay now' : 'أدفع الآن'}}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif
        <table class="order-details">
            <tr>
                <td class="font-weight-bold"  @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Total basket' : 'إجمالي السلة'}}</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            @if ($order->tax > 0)
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Total' : 'المجموع'}}</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Opponent' : 'الخصم'}}</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Total' : 'المجموع'}}</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        <h2 class="heading" @if($locale) style="text-align: left" @endif>{{ $order->locale == 'en' ? 'Data of the applicant' : 'بيانات صاحب الطلب'}}</h2>
        <div class="border">
            {{ $order->first_name }} {{ $order->last_name }} <br />
            {{ $order->phone }} <br />
            {{ $order->email }} <br />
            {{ $order->address }} <br />
        </div>
        @php $url = route('orders'); @endphp
        @component('mail::button', ['url' => $url, 'color' => 'green'])
        {{ $order->locale == 'en' ? 'View the order' : 'عرض الطلب'}}
        @endcomponent
        {{ $order->locale == 'en' ? 'Need help? Do not hesitate to contact us by replying to this message.
        Greetings from the Skills Arts team' : 'تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.
        مع تحيات فريق سكيلز آرتس'}}
        <br>
		https://skillsarts.com<br>
        {{ config('app.name') }}
    </div>
@endcomponent
