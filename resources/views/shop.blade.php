@extends('layouts.app')
@section('title', 'Products')
@section('css')


    <style>
        @media only screen and (max-width: 767px) {
            #hide_mobile {
                display: none;
            }
        }

        .product-bar-content input {
            width: auto !important;
            height: auto !important;
        }
    </style>
    @if (App::getLocale() == 'en')
        <style>
            .blog-header .breadcrumb li:not(:last-of-type)::after {
                content: "";
                position: absolute;
                top: 50%;
                left: -10px;
                width: 0;
                transform: translate(50%, -50%) rotate(181deg);
                height: 0;
                border-style: solid;
                border-width: 25px 12px 25px 0px;
                border-color: transparent #8d9eaf transparent transparent;
            }

            .blog-header .breadcrumb li:not(:last-of-type)::before {
                content: "";
                position: absolute;
                top: 50%;
                left: -14px;
                /* transform: translate(50%); */
                transform: translate(50%, -49%) rotate(181deg);
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 24px 13px 24px 0;
                border-color: transparent #333439 transparent transparent;
                z-index: 1;
            }
        </style>
    @endif
@endsection
@section('content')

    <div class="blog-header text-left">
        <div dir="" class="container " @if (App::getLocale() == 'en') style="text-align: left" @endif>
            <h2 class="h1 mb-3 " @if (App::getLocale() == 'en') style="text-align: left" @endif>
                {{ __('sentence.the_store') }}</h2>
            <ul class="breadcrumb pl-3 pr-3">
                @if (App::getLocale() == 'ar')
                    <li class="">
                        <a href="{{ url('/') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="active"> <a href="{{ url('/shop') }}"
                            class="transition pr-3 pl-3">{{ __('sentence.products') }}</a></li>
                    <li> <a href="#" class="transition">{{ __('sentence.article') }}</a></li>
                @else
                    <li> <a href="#" class="transition">{{ __('sentence.article') }}</a></li>
                    <li class="active"> <a href="{{ url('en/shop') }}"
                            class="transition pr-3 pl-3">{{ __('sentence.products') }}</a></li>
                    <li class="">
                        <a href="{{ url('/en') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <section class="product-list">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 mt-3">
                        <div class="card bg-dark h-100">
                            <a href="{{ $product->path() }}" class="card-link">
                                <img class="card-img" src="{{ Voyager::image($product->thumbnail('small')) }}"
                                    alt="Vans">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title"><a class="card-link"
                                        href="{{ $product->path() }}">{{ Str::limit($product->translate(app()->getLocale())->name, $limit = 20, $end = '...') }}</a>
                                </h4>
                                {!! Str::limit(strip_tags($product->translate(app()->getLocale())->description), $limit = 50, $end = '...') !!}

                                @if ($product->saleprice)
                                    <h6><del
                                            class="mr-2">{{ Shop::price($product->price) }}</del>{{ Shop::price($product->saleprice) }}
                                    </h6>
                                @else
                                    <h6>{{ Shop::price($product->price) }} </h6>
                                @endif
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" class="form-control qty" value="1" min="1"
                                        name="quantity">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    <button class="btn btn-red mt-1">
                                        أضف للسلة
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="{{ asset('js/vendor/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.slider-rtl.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            filter_data();
            $(document).on('click', '.ajax .pagination a', function(event) {
                event.preventDefault();
                $("html, body").animate({
                    scrollTop: 150
                }, "slow");
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var page = $(this).attr('href').split('page=')[1];
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var category = get_filter('category');
                var color = get_filter('color');
                var texture = get_filter('texture');

                var orderbyprice = $('#orderbyprice').val();
                $.ajax({
                    url: 'productfilter?page=' + page,
                    method: "get",
                    data: {
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        category: category,
                        orderbyprice: orderbyprice,
                        color: color,
                        texture: texture
                    },
                    success: function(data) {
                        //$('.filter_data').html(data);
                        $('.data').html(data);
                    }
                });
            });

            function filter_data() {
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var category = get_filter('category');
                var orderbyprice = $('#orderbyprice').val();
                var color = get_filter('color');
                var texture = get_filter('texture');
                $.ajax({
                    url: "productfilter",
                    method: "get",
                    data: {
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        category: category,
                        orderbyprice: orderbyprice,
                        color: color,
                        texture: texture
                    },
                    success: function(response) {
                        $('.data').html(response);
                        //console.log(response);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }
            $("#orderbyprice").change(function() {
                filter_data();
            });
            $('.common_selector').click(function() {
                filter_data();
            });
            $('#slider-range').slider({
                range: true,
                min: 0,
                max: 2000,
                isRTL: true,
                values: [1, 1000],
                stop: function(event, ui) {
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                },
                slide: function(event, ui) {
                    $("#amount").val(ui.values[1] + "SAR" + " -" + ui.values[0] + "SAR");
                }

            });
            $("#amount").val($("#slider-range").slider("values", 1) + "SAR" +
                " - " + $("#slider-range").slider("values", 0) + "SAR");
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#mobile_category").click(function() {
                $("#hide_mobile").toggle();
            });
        });
    </script>
@endsection
