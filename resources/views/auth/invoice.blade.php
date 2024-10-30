@extends('layouts.app')
@section('title', 'Invoice')
@section('css')
    @if (App::getLocale() == 'en')
        <style>
            .invoice_section {
                text-align: left
            }
        </style>
    @endif
@endsection
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark">
                    <div class="card-header invoice_section">
                        <button onclick="printDiv('printableArea')" class="btn btn-inline"><i class="fa fa-print"></i>{{ __('sentence.print') }}</button>
                    </div>
                    <div class="card-body" id="printableArea">
                        <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="row justify-content-between">
                            <div class="col-md-12 text-center mb-4">
                                <img src="{{ Voyager::image(setting('site.invoice_logo')) }}" alt="">
                            </div>
                            <div class="col-sm-6 col-md-4 pull-left invoice_section">
                                <h4 class="mt-3">{{ __('sentence.bill_of_sale') }}</h4>
                                <p>
                                    {{ __('sentence.invoice_no') }}: {{ $order->id }} <br>
                                    {{ __('sentence.invoice_date') }}: {{ $order->created_at->format('d M, Y') }} <br>
                                </p>

                            </div>
                            <div class="col-sm-6 col-md-4 mb-3 invoice_section">
                                <h4 class="mt-3">{{ __('sentence.application_summary') }}</h4>
                                <p>
                                    {{ __('sentence.order_status') }}: {{ $order->status($order->status) }} <br>
                                    {{ __('sentence.order_value') }}: {{ Shop::price($order->total) }} <br>
                                </p>

                            </div>

                            <div class="col-sm-6 col-md-4 invoice_section">
                                <h4 class="mt-3">{{ __('sentence.exported_to') }}:</h4>
                                <p> {{ $order->first_name . ' ' . $order->last_name }} <br>
                                    {{ $order->phone }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="card bg-dark">
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <h4 class="panel-title invoice_section">{{ __('sentence.service_data') }}</h4>

                                            <div class="table-responsive">
                                                @if ($order->type == 1)
                                                    <table class="table table-hover no-footer">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    {{ __('sentence.Service') }}
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">
                                                                    {{ __('sentence.details') }}
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
                                                @else
                                                    <table class="table table-hover no-footer">
                                                        <thead>
                                                            <tr role="row">

                                                                <th class="sorting invoice_section" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">{{ __('sentence.product_name') }}
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">{{ __('sentence.quantity') }}
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">{{ __('sentence.the_price') }}
                                                                </th>
                                                                <th class="sorting" colspan="1" rowspan="1"
                                                                    style="width: 15px;" tabindex="0">{{ __('sentence.the_total') }}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $product)
                                                                <tr class="even" role="row">
                                                                    <td class="invoice_section">
                                                                        <div> {{ $product->translate(app()->getLocale())->name }}</div>
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
                                                {{ __('sentence.Payments') }}
                                            </h4>
                                            <br>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            {{ __('sentence.Value') }}
                                                        </th>
                                                        <th>
                                                            {{ __('sentence.the_date') }}
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
                                                        <b>{{ __('sentence.Paid') }}</b>{{ Shop::price($order->paid()) }} <br>
                                                        <b>{{ __('sentence.the_rest') }}</b>{{ Shop::price($order->due()) }} <br>
                                                        <b>{{ __('sentence.payment_Total') }} </b> {{ Shop::price($order->total) }} <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="row justify-content-end ">
                                                <div class="col-sm-12 col-md-4 ">

                                                    <p>
                                                        @if ($order->tax > 0)
                                                            <b>{{ __('sentence.VAT') }}</b>
                                                            {{ Shop::price($order->tax) }}<br>
                                                        @endif
                                                        <b>{{ __('sentence.cart_total') }}</b> {{ Shop::price($order->subtotal) }} <br>
                                                        @if ($order->discount > 0)
                                                            <b>{{ __('sentence.opponent') }} </b> {{ Shop::price($order->discount) }} <br>
                                                        @endif
                                                        <b>{{ __('sentence.the_total') }}</b> {{ Shop::price($order->total) }} <br>
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
