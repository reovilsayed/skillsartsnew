@extends('voyager::master')
@section('page_title', 'Orders')
@section('page_header')
    <h1 class="page-title hidden-print">
        <i class="{{ $dataType->icon }}"></i> Orders &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.' . $dataType->slug . '.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                Edit
            </a>
        @endcan
        <a href="{{ route('voyager.' . $dataType->slug . '.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Order List
        </a>
        <button onClick="window.print()" class="btn btn-dark" id="print">
            <span class="glyphicon glyphicon-print"></span>&nbsp;
            Print
        </button>

    </h1>
    @include('voyager::multilingual.language-selector')
@stop
@section('content')
    <style type="text/css">
        table.dataTable tbody td,
        table.dataTable tbody th {
            padding: 12px 19px;
        }

        .border {
            border: 1px solid #eee;
        }

        .p-2 {
            padding: 15px;
        }

        p {
            font-size: 17px
        }

        .mb-0 {
            margin-bottom: 0 !important;
            color: #000;
        }

    </style>
    <style>
        @page {
            size: auto;
            margin: 0mm;
        }

    </style>
    <div class="page-content read container-fluid" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 text-center" style="margin-bottom: 20px">
                                <img src="{{ Voyager::image(setting('site.invoice_logo')) }}" alt="">
                            </div>
                            <div class="col-xs-6 mb-0">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h4 style="margin: 0">ملخص الطلب</h4>
                                        <p>
                                            حالة الطلب: {{ $order->status($order->status) }} <br>
                                            قيمة الطلب: {{ Shop::price($order->total) }} <br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 pull-right">
                                <h4>فاتورة بيع</h4>
                                <p>
                                    رقم الفاتورة: {{ $order->id }} <br>
                                    تاريخ الفاتورة: {{ $order->created_at->format('d M, Y') }} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-6">
                                <p><b>مصدرة إلى:</b></p>
                                <p> {{ $order->first_name . ' ' . $order->last_name }}<br>
                                    {{ $order->phone }}
                                </p>
                            </div>
                            <div class="col-sm-3 pull-right">
                                <h4 style="margin: 0">Payment Status</h4>
                                <p style="color: red">
                                    {{ $order->PaymentStatus() }} <br>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($order->type == 0)
                        <div class="card">
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <table class="table table-hover no-footer">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" colspan="1" rowspan="1" style="width: 15px;"
                                                    tabindex="0">
                                                    المنتج
                                                </th>
                                                <th class="sorting" colspan="1" rowspan="1" style="width: 15px;"
                                                    tabindex="0">
                                                    الكمية
                                                </th>
                                                <th class="sorting" colspan="1" rowspan="1" style="width: 15px;"
                                                    tabindex="0">
                                                    السعر
                                                </th>
                                                <th class="sorting" colspan="1" rowspan="1" style="width: 15px;"
                                                    tabindex="0">
                                                    المجموع شامل الضريبة
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr class="even" role="row">

                                                    <td>
                                                        <div> {{ $product->name }}</div>
                                                        @if ($product->variation)
                                                            {{ json_encode($product->variation) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>{{ $product->pivot->quantity }}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{ Shop::price($product->pivot->price) }}</div>
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
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <table class="table table-hover no-footer">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" colspan="1" rowspan="1" style="width: 15px;"
                                                    tabindex="0">
                                                    الخدمة
                                                </th>
                                                <th class="sorting" colspan="1" rowspan="1" style="width: 15px;"
                                                    tabindex="0">
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
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card" style="padding-bottom: 30px">
                        <div class="card-body">
                            <div class="col-xs-6 pull-right text-left">
                                <p>
                                    @if ($order->discount > 0)
                                        <b>المجموع: </b> {{ Shop::price($order->subtotal) }} <br>
                                        <b>الخصم: </b> {{ Shop::price($order->discount) }} <br>
                                    @endif

                                    <b>الإجمالي: </b> {{ Shop::price($order->total) }} <br>
                                    @if ($order->type == 1)
                                        <b>Paid:</b> {{ Shop::price($order->paid()) }} <br>
                                        <b>Due:</b> {{ Shop::price($order->due()) }}
                                    @endif
                                    <br>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($order->type == 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="panel-body">
                            <form action="{{ route('create.charge', $order->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="subtotal">Subtotal</label>
                                        <input  class="form-control" name="subtotal"
                                            id="subtotal" value="{{$order->subtotal}}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="total">Total</label>
                                        <input  class="form-control" name="total"
                                            id="total" value="{{$order->total}}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="percentage">Percentage</label>
                                        <input min="0" type="number" step="any" class="form-control" name="percentage"
                                            id="percentage">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Amount</label>
                                        <input min="0" type="number" step="any" class="form-control" name="amount"
                                            id="amount" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Percentage</th>
                                    <th scope="col">Charge Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->charges as $charge)
                                    <tr>
                                        <th>{{ $charge->id }}</th>
                                        <th>{{ Shop::price($charge->amount) }}</th>
                                        <th>{{ $charge->percentage }}%</th>
                                        <th>{{ $charge->created_at->format('d M Y') }}</th>
                                        <th>
                          
                                        <!-- <a href="https://wa.me/?phone={{ $charge->order->phone}}&text=Hi+here+is+your+invoice https://demo.skillsarts.com/payment/{{$order->id}}"
                                                    class="btn btn-success">WhatsApp</a> -->
                                        @if ($charge->order->phone)
                                        <a href="https://api.whatsapp.com/send/?phone={{$charge->order->phone}}&text={{urlencode('Message here')}} {{route('payment',$order)}}"
                                                    class="btn btn-success">WhatsApp</a>
                                        @endif
                                              
                                            <button
                                                class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                                            @if ($order->status == 0)
                                                <a href="{{ route('send.charge.invoice', $charge->id) }}"
                                                    class="btn btn-primary">Send Invoice</a>
                                   
                                                <a onclick="confirm('Are you sure want to delete this charge?')"
                                                    href="{{ route('delete.charge', $charge->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                                @if ($order->charges->count() > 0)
                                    <tr>
                                        <th>Total</th>
                                        <th>{{ Shop::price($order->charges->sum('amount')) }}</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@section('javascript')
    <script>
        var total = parseFloat({{ $order->total }}).toFixed(2);
        var percentage;
        var amount;
        $('#percentage').keyup(function() {
            percentage = $(this).val();
            amount = parseFloat((total * percentage) / 100).toFixed(2);
            $('#amount').val(amount);
        })
    </script>
    @if (request('action'))
        <script>
            $("#print").click();
        </script>
    @endif

    @if ($isModelTranslatable)
        <script>
            $(document).ready(function() {
                $('.side-body').multilingual();
            });
        </script>
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
@stop
