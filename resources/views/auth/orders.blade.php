@extends('layouts.app')
@section('title', 'Orders')
@section('css')
  <link rel="stylesheet" href="{{asset('css/custom/account.css')}}">
  
@stop
@section('content')
    <section class="account-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   @include('auth.navigation')
                </div>
            </div>
            <div dir="rtl" class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card bg-dark">
                        <div class="card-header">الطلبات</div>
                        <div class="card-body">
                            @if ($orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>تاريخ الطلب</th>
                                                <th>رقم الفاتورة</th>
                                                <th>المجموع</th>
                                                <th>تفاصيل الطلب</th>
                                                <th>حالة الطلب والدفع</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ Shop::price($order->total) }}</td>
                                                    <td>
                                                        <a href="{{ route('invoice', ['order' => $order->id]) }}"
                                                            class="btn btn-info p-1">معاينة الفاتورة</a>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-{{ $order->status == 0 ? 'danger' : 'success' }} p-1">{{ $order->status($order->status) }}</a>
                                                        @if ($order->status == 0)
                                                            <a href="{{ route('payment', $order) }}"
                                                                class="btn btn-success p-1">ادفع الآن</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $orders->links() }}
                            @else
                                <h3 class="text-center"> لم تقم بأي طلب </h3>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
