@extends('layouts.app')
@section('title', 'Orders')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/account.css') }}">

    @if (App::getLocale() == 'en')
        <style>
            .requests {
                text-align: left
            }
        </style>
    @endif
@stop
@section('content')
    <section class="account-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('auth.navigation')
                </div>
            </div>
            <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card bg-dark">
                        <div class="card-header requests">{{ __('sentence.requests') }}</div>
                        <div class="card-body">
                            @if ($orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>{{ __('sentence.order_date') }}</th>
                                                <th>{{ __('sentence.Invoice_number') }}</th>
                                                <th>{{ __('sentence.the_total') }}</th>
                                                <th>{{ __('sentence.order_details') }}</th>
                                                <th>{{ __('sentence.order_and_payment_status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ Shop::price($order->total) }}</td>
                                                    <td>
                                                        @if (App::getLocale() == 'ar')
                                                            <a href="{{ url('ar/invoice', ['order' => $order->id]) }}"
                                                                class="btn btn-info p-1">{{ __('sentence.Invoice_Preview') }}</a>
                                                        @else
                                                            <a href="{{ url('en/invoice', ['order' => $order->id]) }}"
                                                                class="btn btn-info p-1">{{ __('sentence.Invoice_Preview') }}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-{{ $order->status == 0 ? 'danger' : 'success' }} p-1">{{ $order->status($order->status) }}</a>
                                                        @if ($order->status == 0)
                                                            @if (App::getLocale() == 'ar')
                                                                <a href="{{ url('ar/payment', $order) }}"
                                                                    class="btn btn-success p-1">{{ __('sentence.pay_now') }}</a>
                                                            @else
                                                                <a href="{{ url('en/payment', $order) }}"
                                                                    class="btn btn-success p-1">{{ __('sentence.pay_now') }}</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $orders->links() }}
                            @else
                                <h3 class="text-center">{{ __('sentence.you_have_not_made_any_request') }}</h3>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
