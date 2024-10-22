@extends('layouts.app')
@section('title', 'Invoice')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark">
                    <div class="card-header">
                        <button onclick="printDiv('printableArea')" class="btn btn-inline"><i class="fa fa-print"></i>
                            طباعة</button>
                    </div>
                    <div class="card-body" id="printableArea">
                        <div dir="rtl" class="row justify-content-between">
                            <div class="col-md-12 text-center mb-4">
                                <img src="{{ Voyager::image(setting('site.invoice_logo')) }}" alt="">
                            </div>
                            <div class="col-sm-6 col-md-4 pull-left">
                                <h4 class="mt-3">فاتورة بيع</h4>
                                <p>
                                    رقم الفاتورة: {{ $order->id }} <br>
                                    تاريخ الفاتورة: {{ $order->created_at->format('d M, Y') }} <br>
                                </p>

                            </div>
                            <div class="col-sm-6 col-md-4 mb-3">
                                <h4 class="mt-3">ملخص الطلب</h4>
                                <p>
                                    حالة الطلب: {{ $order->status($order->status) }} <br>
                                    قيمة الطلب: {{ Shop::price($order->total) }} <br>
                                </p>
                     
                            </div>
       
                            <div class="col-sm-6 col-md-4">
                            <h4 class="mt-3">مصدرة إلى:</h4>
                                <p> {{ $order->first_name . ' ' . $order->last_name }} <br>
                                    {{ $order->phone }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div dir="rtl" class="card bg-dark">
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <h4 class="panel-title">بيانات الخدمة</h4>

                                            <div class="table-responsive">
                                                @if ($order->type == 1)
                                                    <table class="table table-hover no-footer">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    الخدمة
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
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
                                                                                    {{json_encode($value) }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover no-footer">
                                                        <thead>
                                                            <tr role="row">

                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    اسم المنتج
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    الكمية
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    السعر
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    المجموع
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $product)
                                                                <tr class="even" role="row">
                                                                    <td>
                                                                        <div> {{ $product->name }}</div>
                                                                    </td>
                                                                    <td>
                                                                        <div> {{ $product->pivot->quantity }}</div>
                                                                    </td>
                                                                    <td>
                                                                        <div>{{ Shop::price($product->pivot->price) }}
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div>
                                                                            {{ Shop::price($product->pivot->price * $product->pivot->quantity) }}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @if ($order->type == 1)
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <h4 class="panel-title">
                                                الدفعات
                                            </h4>
                                            <br>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            القيمة
                                                        </th>
                                                        <th>
                                                           التاريخ
                                                        </th>
                                                    </tr>
                                                    @foreach ($order->charges()->where('status', 1)->get() as $charge)
                                                        <tr>
                                                            <td>
                                                                {{ Shop::price($charge->amount) }}
                                                            </td>
                                                            <td>
                                                                {{ $charge->created_at->format('d M Y') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <div dir="rtl" class="row justify-content-end ">
                                                <div class="col-sm-12 col-md-4 ">

                                                    <p>
                                                        <b>تم سداد:</b>{{ Shop::price($order->paid()) }} <br>
                                                        <b>الباقي:</b>{{ Shop::price($order->due()) }} <br>
                                                        <b>الإجمالي: </b> {{ Shop::price($order->total) }} <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <div dir="rtl" class="row justify-content-end ">
                                                <div class="col-sm-12 col-md-4 ">

                                                    <p>
                                                        @if ($order->tax > 0)
                                                            <b>ضريبة القيمة المضافة: </b>
                                                            {{ Shop::price($order->tax) }}<br>
                                                        @endif
                                                        <b>إجمالي السلة: </b> {{ Shop::price($order->subtotal) }} <br>
                                                        @if ($order->discount > 0)
                                                            <b>الخصم: </b> {{ Shop::price($order->discount) }} <br>
                                                        @endif
                                                        <b>المجموع: </b> {{ Shop::price($order->total) }} <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
