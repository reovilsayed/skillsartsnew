@component('mail::message')
    @php
        $locale = $order->locale == 'en';
    @endphp
    {{-- @dd($locale) --}}
    <h1 class="title" @if ($locale) style="text-align: left" @endif>
        {{ $order->locale == 'en' ? 'Invoice for the order' : 'فاتورة للطلب'}} #{{ $order->id }}</h1>
    <div class="body-section" @if ($locale) style="direction: ltr" @endif>
        {{ $order->locale == 'en' ? 'Hello,' : 'السلام عليكم'}} {{ $order->first_name }} {{ $order->last_name }} <br>
        {{ $order->locale == 'en' ? 'The request was made in' : 'الطلب الذي تم في'}}
        {{ $order->created_at->format('M d, Y') }}
        {{ $order->locale == 'en' ? 'It has been confirmed' : 'تم تأكيده'}}<br />
        <table class="order-details">
            <tr>
                <th @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'en' ? 'Product' : 'المنتج'}}</th>
                <th @if ($locale) style="text-align: center" @endif>
                    {{ $order->locale == 'en' ? 'Quantity' : 'الكمية'}} </th>
                <th @if ($locale) style="text-align: center" @endif>
                    {{ $order->locale == 'en' ? 'Price' : 'السعر'}}</th>
            </tr>
            @foreach ($order->products as $product)
                <tr>
                    <td @if ($locale) style="text-align: left" @endif>{{ $product->name }}</td>
                    <td @if ($locale) style="text-align: center" @endif>{{ $product->pivot->quantity }}
                    </td>
                    <td @if ($locale) style="text-align: center" @endif>
                        {{ Shop::price($product->price) }} </td>
                </tr>
            @endforeach
        </table> <br />
        <table class="order-details">
            <tr>
                <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'en' ? 'Total basket' : 'إجمالي السلة'}}</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'en' ? 'Tax' : 'الضريبة'}}</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @if ($order->shipping_cost > 0)
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                        {{ $order->locale == 'en' ? 'Shipping value' : 'قيمة الشحن'}}</td>
                    <td>{{ Shop::price($order->shipping_cost) }}</td>
                </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                        {{ $order->locale == 'en' ? 'Opponent' : 'الخصم'}}</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'en' ? 'The Total' : 'المجموع'}}</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        <h2 class="heading" @if ($locale) style="text-align: left" @endif>
            {{ $order->locale == 'en' ? 'Customer data' : 'بيانات العميل'}}</h2>
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
        {{ $order->locale == 'en' ? 'View order' : 'عرض الطلب'}}
        @endcomponent
        {{ $order->locale == 'en'
            ? 'Need help? Do not hesitate to contact us by replying to this message.
            Greetings from the Skills Arts team' : 'تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.
        مع تحيات فريق سكيلز آرتس'}}
        <br>
        https://skillsarts.com<br>
        {{ config('app.name') }}
    </div>
@endcomponent
