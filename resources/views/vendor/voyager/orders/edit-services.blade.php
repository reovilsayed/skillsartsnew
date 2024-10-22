@extends('voyager::master')
@section('page_title', 'Edit Services')
@section('css')
    @livewireStyles
    <style>
        .font-weight-bold {
            font-weight: bold !important;
        }

        .mb-0 {
            margin-bottom: 0
        }

    </style>
    <style>
        a:hover,
        a:focus {
            text-decoration: none;
            outline: none;
        }

        #accordion .panel {
            border: none;
            border-radius: 0;
            box-shadow: none;
            margin: 0 0 10px;
            overflow: hidden;
            position: relative;
        }

        #accordion .panel-heading {
            padding: 0;
            border: none;
            border-radius: 0;
            margin-bottom: 10px;
            z-index: 1;
            position: relative;
        }

        #accordion .panel-heading:before,
        #accordion .panel-heading:after {
            content: "";
            width: 50%;
            height: 20%;

            position: absolute;
            bottom: 15px;
            left: 10px;
            transform: rotate(-3deg);
            z-index: -1;
        }

        #accordion .panel-heading:after {
            left: auto;
            right: 10px;
            transform: rotate(3deg);
        }

        #accordion .panel-title a {
            display: block;
            padding: 15px 70px 15px 70px;
            margin: 0;
            background: #fff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #d11149;
            border-radius: 0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            position: relative;
        }

        #accordion .panel-title a:before,
        #accordion .panel-title a.collapsed:before {
            content: "\f106";
            font-family: "FontAwesome";
            font-weight: 900;
            width: 55px;
            height: 100%;
            text-align: center;
            line-height: 50px;
            border-left: 2px solid #D11149;
            position: absolute;
            top: 0;
            right: 0;
        }

        #accordion .panel-title a.collapsed:before {
            content: "\f107";
        }

        #accordion .panel-title a .icon {
            display: inline-block;
            width: 55px;
            height: 100%;
            border-right: 2px solid #d11149;
            font-size: 20px;
            color: rgba(0, 0, 0, 0.7);
            line-height: 50px;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
        }

        #accordion .panel-body {
            padding: 10px 20px;
            margin: 0 0 20px;
            border-bottom: 3px solid #d11149;
            border-top: none;
            background: #fff;
            font-size: 15px;
            color: #333;
            line-height: 27px;
        }

    </style>
@stop
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-edit"></i>
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="{{ route('update.services', $order) }}">
                            @csrf
                            <livewire:calculator :services="(array) $services" />
                            <button class="btn btn-lg btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form class="form-edit-add" action="{{ route('update.services.amount', $order) }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="sub_total" class="control-label">Sub Total</label>
                        <input type="text" class="form-control" step="any" id="sub_total"
                            value="{{ $order->subtotal }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="total_price" class="control-label">Total</label>
                        <input type="text" class="form-control" id="total_price" name="total" value="{{ $order->total }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="discount" class="control-label">Discount</label>
                        <input type="text" class="form-control" step="any" id="discount" name="discount"
                            value="{{ $order->discount }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="discount_percentage" class="control-label">Discount Percentage</label>
                        <input type="number" class="form-control" step="any" id="discount_percentage"
                            name="discount_percentage">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div
@stop
@section('css')

@stop

@section('javascript')
    <!-- Twitter Bootstrap -->
    <script>
        console.log('test');
        $('#total_price').attr('readonly', true);
        $('#sub_total').attr('readonly', true);
        var sub_total = $('#sub_total').val();
        var discount = $('#discount').val();
        $('#discount_percentage').val(parseFloat(100 * discount / sub_total).toFixed(2));
        $('#discount').keyup(() => {
            var sub_total = $('#sub_total').val();
            var discount = $('#discount').val();
            $('#total_price').val(parseFloat(sub_total - discount).toFixed(2));
            $('#discount_percentage').val(parseFloat(100 * discount / sub_total).toFixed(2));
        });
        $('#discount_percentage').keyup(() => {
            var sub_total = $('#sub_total').val();
            var discount_percentage = $('#discount_percentage').val();
            $('#discount').val(parseFloat(sub_total * discount_percentage / 100).toFixed(2));
            $('#total_price').val(parseFloat(sub_total - (sub_total * discount_percentage / 100)).toFixed(2));
            //console.log(total,discount,discount_percentage);
        })
    </script>

    <script src="{{ asset('home-page/js/bootstrap.min.js') }}"></script>

    @livewireScripts

    <script>
        for (el of document.getElementsByClassName('custom-control-label')) {
            return el.click();
        }
    </script> -->
    <script>
        @if ($services != null)
            $( document ).ready(function() {
            @if (array_key_exists('logo', $services))
                $('#logoswitch').click();
            @endif
            @if (array_key_exists('profile', $services))
                $('#profileswitch').click();
            @endif
            @if (array_key_exists('identity', $services))
                $('#identityswitch').click();
            @endif
            @if (array_key_exists('website', $services))
                $('#websiteswitch').click();
            @endif

            });
        @endif
    </script>
@stop
