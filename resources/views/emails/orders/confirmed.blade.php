@component('mail::message')
    @php
        $locale = $order->locale == 'en';
    @endphp
    {{-- @dd($locale) --}}
    <h1 class="title" @if ($locale) style="text-align: left" @endif>
        {{ $order->locale == 'ar' ? 'فاتورة للطلب' : 'Invoice for the order' }} #{{ $order->id }}</h1>
    <div class="body-section" @if ($locale) style="direction: ltr" @endif>
        {{ $order->locale == 'ar' ? 'السلام عليكم' : 'Hello,' }} {{ $order->first_name }} {{ $order->last_name }} <br>
        {{ $order->locale == 'ar' ? 'الطلب الذي تم في' : 'The request was made in' }}
        {{ $order->created_at->format('M d, Y') }}
        {{ $order->locale == 'ar' ? 'تم تأكيده' : 'It has been confirmed' }}<br />
        <table class="order-details">
            <tr>
                <th @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'ar' ? 'المنتج' : 'Product' }}</th>
                <th @if ($locale) style="text-align: center" @endif>
                    {{ $order->locale == 'ar' ? 'الكمية' : 'Quantity' }} </th>
                <th @if ($locale) style="text-align: center" @endif>
                    {{ $order->locale == 'ar' ? 'السعر' : 'Price' }}</th>
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
                    {{ $order->locale == 'ar' ? 'إجمالي السلة' : 'Total basket' }}</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'ar' ? 'الضريبة' : 'Tax' }}</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @if ($order->shipping_cost > 0)
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                        {{ $order->locale == 'ar' ? 'قيمة الشحن' : 'Shipping value' }}</td>
                    <td>{{ Shop::price($order->shipping_cost) }}</td>
                </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                        {{ $order->locale == 'ar' ? 'الخصم' : 'Opponent' }}</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold" @if ($locale) style="text-align: left" @endif>
                    {{ $order->locale == 'ar' ? 'المجموع' : 'The Total' }}</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        <h2 class="heading" @if ($locale) style="text-align: left" @endif>
            {{ $order->locale == 'ar' ? 'بيانات العميل' : 'Customer data' }}</h2>
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
        {{ $order->locale == 'ar' ? 'عرض الطلب' : 'View the order'}}
        @endcomponent
        {{ $order->locale == 'ar'
            ? 'تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.
        مع تحيات فريق سكيلز آرتس'
            : 'Need help? Do not hesitate to contact us by replying to this message.
        Greetings from the Skills Arts team' }}
        <br>
        https://skillsarts.com<br>
        {{ config('app.name') }}
    </div>
@endcomponent
