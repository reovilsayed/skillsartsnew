@component('mail::message')
    <h1 class="title" @if($locale == 'en') style="text-align:left" @endif >{!! $data->title !!} </h1>
    <div class="body-section"  @if($locale == 'en') style="text-align:left" @endif>
        <span @if($locale == 'en') style="direction: ltr; text-align:left" @endif>{!! $data->opening_message !!}</span><br />
        @if ($locale == 'ar')
            رقم الطلب :
        @else
            Order number
        @endif {{ $order->id }}<br />
        @if ($order->type == 0)
            <table class="order-details" @if($locale == 'en') style="direction: ltr" @endif>
                <tr>
                    @if ($locale == 'ar')
                        <th>الخدمة</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                    @else
                        <th @if($locale == 'en') style="text-align:center" @endif>Service</th>
                        <th @if($locale == 'en') style="text-align:center" @endif>Quantity</th>
                        <th @if($locale == 'en') style="text-align:center" @endif>Price</th>
                    @endif
                </tr>
                @foreach ($order->products as $product)
                    <tr>
                        <td @if($locale == 'en') style="text-align:left" @endif>
                            {{ $product->name }} <br>
                            @if ($product->status == 0)
                                {{ Str::limit(strip_tags($product->details), $limit = 800, $end = '...') }}
                            @endif
                        </td>
                        <td @if($locale == 'en') style="text-align:center" @endif>{{ $product->pivot->quantity }} </td>
                        <td @if($locale == 'en') style="text-align:center" @endif>{{ Shop::price($product->pivot->price) }} </td>
                    </tr>
                @endforeach
            </table> <br />
        @else
            <table class="order-details"  @if($locale == 'en') style="direction: ltr" @endif>
                <thead>
                    <tr role="row">
                        @if ($locale == 'ar')
                            <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0">
                                الخدمة
                            </th>
                            <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0">
                                تفاصيل
                            </th>
                        @else
                            <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0"  @if($locale == 'en') style="text-align:center" @endif>
                                Service
                            </th>
                            <th class="sorting" colspan="1" rowspan="1" style="width: 15px;" tabindex="0"  @if($locale == 'en') style="text-align:center" @endif>
                                Details
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($order->services) as $name => $details)
                        <tr>
                            <td  @if($locale == 'en') style="text-align:left" @endif>
                                {{ ucfirst($name) }}
                            </td>
                            <td  @if($locale == 'en') style="text-align:left" @endif>
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
                <table class="order-details"  @if($locale == 'en') style="direction: ltr" @endif>
                    <tr>
                        @if ($locale == 'ar')
                            <th>#الرمز</th>
                            <th>القيمة</th>
                            <th>تاريخ الفاتورة</th>
                            <th>الحالة</th>
                        @else
                            <th @if($locale == 'en') style="text-align:center" @endif>#Symbol</th>
                            <th @if($locale == 'en') style="text-align:center" @endif>Value</th>
                            <th @if($locale == 'en') style="text-align:center" @endif>Invoice date</th>
                            <th @if($locale == 'en') style="text-align:center" @endif>Condition</th>
                        @endif
                    </tr>
                    @foreach ($order->charges as $charge)
                        <tr>
                            <td @if($locale == 'en') style="text-align:center" @endif>{{ $charge->id }}</td>
                            <td @if($locale == 'en') style="text-align:center" @endif>{{ Shop::price($charge->amount) }} </td>
                            <td @if($locale == 'en') style="text-align:center" @endif>{{ $charge->created_at->format('d-m-Y') }} </td>
                            <td @if($locale == 'en') style="text-align:center" @endif> <button
                                    class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                                @if ($charge->status == 0)
                                    <a href="@if($local == 'ar'){{ url('/payment', $order->id) }}@else{{ url('en/payment', $order->id) }}@endif" class="btn btn-success">
                                        @if ($locale == 'ar')
                                            أدفع الآن
                                        @else
                                            Pay now
                                        @endif
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif
        <table class="order-details"  @if($locale == 'en') style="direction: ltr" @endif>
            <tr>
                @if ($locale == 'ar')
                    <td class="font-weight-bold">إجمالي السلة</td>
                @else
                    <td class="font-weight-bold" @if($locale == 'en') style="text-align:left" @endif>Total basket</td>
                @endif
                <td>{{ Shop::price($order->subtotal) }}</td>
            </tr>
            @if ($order->tax > 0)
                <tr>
                    @if ($locale == 'ar')
                        <td class="font-weight-bold">المجموع</td>
                    @else
                        <td class="font-weight-bold" @if($locale == 'en') style="text-align:left" @endif>Total</td>
                    @endif
                    <td>{{ Shop::price($order->tax) }}</td>
                </tr>
            @endif
            @if ($order->discount > 0)
                <tr>
                    @if ($locale == 'ar')
                        <td class="font-weight-bold">الخصم</td>
                    @else
                        <td class="font-weight-bold" @if($locale == 'en') style="text-align:left" @endif>Opponent</td>
                    @endif
                    <td>{{ Shop::price($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                @if ($locale == 'ar')
                    <td class="font-weight-bold">المجموع</td>
                @else
                    <td class="font-weight-bold" @if($locale == 'en') style="text-align:left" @endif>Total</td>
                @endif
                <td>{{ Shop::price($order->total) }}</td>
            </tr>
        </table>
        @if ($locale == 'ar')
            <h2 class="heading">بيانات صاحب الطلب</h2>
        @else
            <h2 class="heading"  @if($locale == 'en') style="text-align:left" @endif>Data of the applicant</h2>
        @endif
        <div class="border"  @if($locale == 'en') style="text-align:left" @endif>
            {{ $order->first_name }} {{ $order->last_name }} <br />
            {{ $order->phone }} <br />
            {{ $order->email }} <br />
            {{ $order->address }} <br />
        </div>
        @component('mail::button', ['url' => $data->button['url'], 'color' => 'green'])
            {{ $data->button['text'] }}
        @endcomponent
        {!! $data->footer !!}<br />
        {{ config('app.name') }}
    </div>
@endcomponent
