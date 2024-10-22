@extends('layouts.app')
@section('title', 'Payment')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/card.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom/cartlist.css') }}">
    <script src="https://epayment.areeba.com/checkout/version/60/checkout.js" data-error="errorCallback"
        data-cancel="cancelCallback" data-complete="{{ route('thankyou', ['order' => $order]) }}">
    </script>

    <script type="text/javascript">
        function errorCallback(error) {
            console.log(JSON.stringify(error));
        }

        function cancelCallback() {
            console.log('Payment cancelled');
        }

        Checkout.configure({
            merchant: "{{ config('areeba.user_id') }}",
            order: {
                amount: "{{ $order->bill() }}",
                currency: "{{ config('areeba.currency') }}",
                description: "digital products",
                id: "{{ $order->payment_id }}",
            },
            session: {
                id: "{{ $session['response']->session->id }}"
            },
            interaction: {
                operation: 'PURCHASE',
                displayControl:{
                    shipping:'HIDE',
                    billingAddress:'HIDE'
                },
                merchant: {
                    name: "{{ $order->user->name }}",
                    address: {
                        line1: "{{ $order->user->email }}",
                    }
                }
            }
        });
    </script>
@stop
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger mb-2 text-center">يرجى السداد لتأكيد طلبك</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div dir="rtl" class="cart-totals w-100">
                    <h2 class="title">مجموع السلة</h2>
                    @if ($order->type == 0)
                        <ul>
                            <li><span>المجموع الكلي</span><span>{{ Shop::price($order->bill()) }}</span></li>
                        </ul>
                    @else
                    الدفعات والفوترة السابقة
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">الحالة</th>
                                <th scope="col">تاريخ الفوترة</th>
                                <th scope="col">نسبة السداد</th>
                                <th scope="col">المبلغ</th>
                                <th scope="col">رقم السداد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->charges as $charge)
                                <tr>
                                    <th><button class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button></th>
                                    <th>{{ $charge->created_at->format('d M Y') }}</th>
                                    <th>{{$charge->percentage }}%</th>
                                    <th>{{ Shop::price($charge->amount) }}</th>
                                    <th>{{ $charge->id }}</th>
                                </tr>
                            @endforeach
                            <tr>
                            <th colspan="3">
                            </th>
                                <th>{{ Shop::price($order->charges->sum('amount')) }}</th>
                                <th>المجموع</th>
                            </tr>
                            <tr>
                            <th colspan="3">
                            </th>
                                <th>{{ Shop::price($order->total) }}</th>
                                <th>الإجمالي</th>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card mb-1">
                    <div class="card-body text-center" style="background:#">
                        <input type="button" class="btn btn-outline-danger"
                            value=" {{ Shop::price($order->bill()) }}:سدد الآن " onclick="Checkout.showLightbox();" />

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

    <script type="text/javascript">
        $('#reset').click(function() {
            $('#card_form').trigger("reset");
        });
    </script>

@endsection
