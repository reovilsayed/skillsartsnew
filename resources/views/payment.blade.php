@extends('layouts.app')
@section('title', 'Payment')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/card.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('css/custom/cartlist.css') }}">
    <script src="https://epayment.areeba.com/checkout/version/60/checkout.js" data-error="errorCallback"
        data-cancel="cancelCallback" data-complete="{{ route('thankyou', ['order' => $order]) }}"></script>

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
            if (isset($response - > session - > id)) {
                return [
                    'response' => $response,
                    'order' => ['id' => request() - > order - > id, 'uniqid' => $id]
                ];
            } else {
                \
                Log::error("Session ID is missing in Areeba API response", ['response' => $response]);
                throw new\ Exception("Failed to retrieve session ID from Areeba API.");
            },
            interaction: {
                operation: 'PURCHASE',
                displayControl: {
                    shipping: 'HIDE',
                    billingAddress: 'HIDE'
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
                <h3 class="text-danger mb-2 text-center">{{ __('sentence.Please_make_payment_to_confirm_your_order') }}</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div dir="rtl" class="cart-totals w-100">
                    <h2 class="title">{{ __('sentence.total_basket') }}</h2>
                    @if ($order->type == 0)
                        <ul>
                            <li><span>{{ __('sentence.payment_Total') }}</span><span>{{ Shop::price($order->bill()) }}</span></li>
                        </ul>
                    @else
                    {{ __('sentence.Past_payments_and_billing') }}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('sentence.the_condition') }}</th>
                                    <th scope="col">{{ __('sentence.Billing_date') }}</th>
                                    <th scope="col">{{ __('sentence.Repayment_rate') }}</th>
                                    <th scope="col">{{ __('sentence.Amount') }}</th>
                                    <th scope="col">{{ __('sentence.Payment_number') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->charges as $charge)
                                    <tr>
                                        <th><button
                                                class="btn {{ $charge->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $charge->status() }}</button>
                                        </th>
                                        <th>{{ $charge->created_at->format('d M Y') }}</th>
                                        <th>{{ $charge->percentage }}%</th>
                                        <th>{{ Shop::price($charge->amount) }}</th>
                                        <th>{{ $charge->id }}</th>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3">
                                    </th>
                                    <th>{{ Shop::price($order->charges->sum('amount')) }}</th>
                                    <th>{{ __('sentence.the_total') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3">
                                    </th>
                                    <th>{{ Shop::price($order->total) }}</th>
                                    <th>{{ __('sentence.payment_Total') }}</th>
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
                            value=" {{ Shop::price($order->bill()) }}: {{ __('sentence.pay_now') }}" onclick="Checkout.showLightbox();" />

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
