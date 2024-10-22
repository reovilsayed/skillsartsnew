@component('mail::message')
    <h1 class="title">فاتورة للطلب #{{ $order->id }}</h1>
    <div class="body-section">
        السلام عليكم {{ $order->first_name }} {{ $order->last_name }} <br>
        الطلب الذي تم في {{ $order->created_at->format('M d, Y') }} تم تأكيده<br />

        <table class="order-details">
            <thead>
                <tr role="row">
                    <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0">
                        الخدمة
                    </th>
                    <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0">
                        تفاصيل
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

        <table class="order-details">
            <tr>
                <th>#الرمز</th>
                <th>القيمة</th>
                <th>تاريخ الفاتورة</th>
                <th>الحالة</th>
            </tr>
            @foreach ($order->charges as $charge)
                <tr>
                    <td>{{ $charge->id }}</td>
                    <td>{{ Shop::price($charge->amount) }} </td>
                    <td>{{ $charge->created_at->format('d-m-Y') }} </td>
                    <td> <button
                            class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                        @if ($charge->status == 0)
                            <a href="{{ route('payment', $order->id) }}" class="btn btn-success">أدفع الآن</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <table class="order-details">
            <tr>
                <td class="font-weight-bold">إجمالي السلة</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">الضريبة</td>
                <td>{{ Shop::price($order->tax) }}</td>
            </tr>
            @if ($order->shipping_cost > 0)
                <tr>
                    <td class="font-weight-bold">قيمة الشحن</td>
                    <td>{{ Shop::price($order->shipping_cost) }}</td>
                </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    <td class="font-weight-bold">الخصم</td>
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td class="font-weight-bold">المجموع</td>
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>

        <h2 class="heading">بيانات العميل</h2>
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
            عرض الطلب
        @endcomponent

        تحتاج لمساعدة؟ لا تتردد في التواصل معنا بالرد على هذه الرسالة.
        مع تحيات فريق سكيلز آرتس<br>
        https://skillsarts.com<br>
        {{ config('app.name') }}
    </div>
@endcomponent
