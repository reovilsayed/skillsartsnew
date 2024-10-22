@php
use App\Models\Alert;
use App\Product;
use App\Order;
$alerts = Alert::latest()
    ->limit(5)
    ->get();
$orders = Order::limit(10)
    ->latest()
    ->get();

@endphp
@extends('voyager::master')
@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-5">
                <div class="panel">
                    <div class="panel-body">
                        <h4><span class="icon voyager-bell"></span> التنبيهات</h4>
                        <hr>
                        @foreach ($alerts as $alert)
                            <div class="row">
                                <div class="col-md-3 mb-0 hidden-sm hidden-xs">
                                    <img src="{{ Voyager::image('users/default.png') }}" style="width:100%" alt="">
                                </div>
                                <div class="col-md-9 mb-0">
                                    <strong>{{ $alert->title }}</strong> <br>
                                    <small style="font-weight: bold">{{ $alert->created_at->format('g:i A d M Y') }}</small>
                                </div>
                            </div>
                            <hr style="margin:10px">
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel">
                    <div class="panel-body">
                        <h4> أحدث الطلبات</h4>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">العميل</th>
                                    <th scope="col">السعر</th>
                                    <th scope="col">تاريخ الطلب</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <h4>{{ $order->first_name . ' ' . $order->last_name }}</h4>
                                            <small style="font-weight: bold"><span class="icon voyager-location"></span>
                                                {{ $order->post_code . ' ' . $order->city . ' ' . $order->state }}
                                                <span class="icon voyager-dot"></span> <span
                                                    class="text-{{ $order->status == 1 ? 'success' : '' }}">{{ $order->status($order->status) }}</span>
                                                <span class="icon voyager-dot"></span> رقم الطلب: <a target="_blank"
                                                    href="{{ route('voyager.orders.show', $order->id) }}">{{ $order->id }}</a>
                                            </small>
                                        </td>
                                        <td>{{ Shop::price($order->total) }}</td>
                                        <td>{{ $order->created_at->format('g:i A d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <canvas id="myChart" style="height: 500px"></canvas>

@stop

@section('javascript')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Order', 'Pending', 'Confirmed', 'Cancelled', 'Under Process', 'Done'],
                datasets: [{
                    label: '# of Orders',
                    data: [{{$orders->count()}}, {{$orders->where('status',0)->count()}}, {{$orders->where('status',1)->count()}}, {{$orders->where('status',2)->count()}}, {{$orders->where('status',3)->count()}}, {{$orders->where('status',4)->count()}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


@stop
