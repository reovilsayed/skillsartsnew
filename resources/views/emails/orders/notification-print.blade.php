@component('mail::message')
    <img src="{{Voyager::image(setting('site.invoice_logo'))}}" alt="" style="display: block;margin:10px auto">
    <div class="body-section">
        {!!$data->opening_message!!}<br/>
        رقم الطلب: {{ $order->id }}<br/>
        @if ($order->type == 0)
            <table class="order-details">
                <tr>
                    <th>الخدمة</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                </tr>
                @foreach ($order->products as $product)
                    <tr>
                        <td>
                            {{ $product->name }} <br>
                            @if ($product->status ==0)
                                {{ Str::limit(strip_tags($product->details), $limit = 800, $end = '...')}}
                            @endif
                        </td>
                        <td>{{ $product->pivot->quantity }} </td>
                        <td>{{ Shop::price($product->pivot->price) }} </td>
                    </tr>
                @endforeach
            </table> <br />
        @else
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
            @if ($order->charges->count() > 0)
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
            @endif
        @endif
        <table class="order-details">
            <tr>
                <td class="font-weight-bold">إجمالي السلة</td>
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            @if ($order->tax > 0)
                <tr>
                    <td class="font-weight-bold">المجموع</td>
                    <td>{{ Shop::price($order->tax) }}</td>
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
        <h2 class="heading">بيانات صاحب الطلب</h2>
        <div class="border">
            {{ $order->first_name }} {{ $order->last_name }} <br />
            {{ $order->phone }} <br />
            {{ $order->email }} <br />
            {{ $order->address }} <br/>
        </div>
        {!!$data->footer!!}<br/>
        {{ config('app.name') }}
    </div>
    <script>
        window.print();
    </script>
@endcomponent
