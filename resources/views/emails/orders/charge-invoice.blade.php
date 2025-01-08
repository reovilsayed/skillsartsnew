@component('mail::message')
<h1 class="title">Payment Request #{{ $order->id }}</h1>
<div class="body-section">
السلام عليكم {{ $order->first_name }} {{ $order->last_name }} <br>
طلب سداد جديد ارسل للطلب الذي تم في تاريخ {{$order->created_at->format('M d, Y')}} <br />
تجد ادناه تفاصيل الطلب
 <table class="order-details">
  <tr>
    <th>#الرقم</th>
    <th>القيمة</th>
    <th>تاريخ الفاتورة</th>
    <th>الحالة</th>
  </tr>
@foreach ($order->charges as $charge)
  <tr>
    <td>{{ $charge->id }}</td>
    <td>{{ Shop::price($charge->amount) }} </td>
    <td>{{ $charge->created_at->format('d-m-Y') }} </td>
    <td>  <button
        class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
        @if ($charge->status == 0)
        <a href="{{route('payment',$order->id)}}" class="btn btn-success">أدفع الآن</a>
        @endif
    </td>
  </tr>
@endforeach
</table> <br />
 <table class="order-details">
  <tr>
    <td class="font-weight-bold">المجموع</td>
    <td>{{Shop::price($order->subtotal) }}</td>
  </tr>
  <tr>
    <td class="font-weight-bold">الضريبة</td>
    <td>{{Shop::price($order->tax) }}</td>
  </tr>
@if($order->discount > 0)
  <tr>
    <td class="font-weight-bold">الخصم</td>
    <td>{{Shop::price($order->discount) }}</td>
  </tr>
@endif
  <tr>
    <td class="font-weight-bold">المجموع النهائي</td>
    <td>{{Shop::price($order->total) }}</td>
  </tr>
</table>
<h2 class="heading">العنوان</h2>
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
شكراً مرة أخرى لإستخدامكم موقع سكيلز آرتس
Regards,<br>
{{ config('app.name') }}
</div>
@endcomponent
