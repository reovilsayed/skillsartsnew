@extends('layouts.app')
@section('title', 'cart')
@section('meta-description')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/cartlist.css') }}">
    @if (App::getLocale() == 'en')
        <style>
            .back_to_shopping {
                text-align: left
            }

            #Shopping_cart {
                text-align: left;
            }

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

    <div class="blog-header">
        <div class="container" id="Shopping_cart">
            <h2 class="h1 mb-3">{{ __('sentence.shopping_cart') }}</h2>
            <ul class="breadcrumb pl-3 pr-3">
                @if (App::getLocale() == 'ar')
                    <li class="">
                        <a href="{{ url('/') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="active"> <a href="{{ url('/shop') }}"
                            class="transition pr-3 pl-3">{{ __('sentence.the_store') }}</a></li>
                    <li> <a href="{{ url('/cart') }}" class="transition pr-3 pl-3">{{ __('sentence.basket') }}</a></li>
                @else
                    <li> <a href="{{ url('en/cart') }}" class="transition pr-3 pl-3">{{ __('sentence.basket') }}</a></li>
                    <li class="active"> <a href="{{ url('en/shop') }}"
                            class="transition pr-3 pl-3">{{ __('sentence.the_store') }}</a></li>

                    <li class="">
                        <a href="{{ url('/en') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                    </li>
                @endif


            </ul>
        </div>
    </div>

    <div class="cart-part pt-3 pb-3">
        <div class="container">
            <div class="row justify-content-center mb-2">
                @if (Cart::getTotalQuantity() > 0)
                @else
                    <div class="col-md-6">
                        @if (App::getLocale() == 'ar')
                            <a class="btn btn-inline btn-block"
                                href="{{ url('/shop') }}">{{ __('sentence.continue_shopping') }}</a>
                        @else
                            <a class="btn btn-inline btn-block"
                                href="{{ url('en/shop') }}">{{ __('sentence.continue_shopping') }}</a>
                        @endif
                    </div>
                @endif
            </div>
            @if (Cart::getTotalQuantity() > 0)
                <div class="row">
                    <table class="table-list table-bordered">
                        <thead class="table-dark ">
                            <tr>
                                <th scope="col">{{ __('sentence.product_image') }}</th>
                                <th scope="col">{{ __('sentence.product') }}</th>
                                <th scope="col">{{ __('sentence.quantity') }}</th>
                                <th scope="col">{{ __('sentence.the_price') }}</th>
                                <th scope="col">{{ __('sentence.delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::getContent() as $product)
                                <tr>
                                    <td>
                                        <a href="{{ $product->model->path() }}" class="text-secondary">
                                            <!-- <img src=" https://via.placeholder.com/700x550" alt="" style="width:100px" /> -->
                                            <img src=" {{ Voyager::image($product->model->image) }}" alt=""
                                                style="width:100px" />
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $product->model->path() }}"
                                            class="text-light">{{ $product->model->translate(app()->getLocale())->name }}</a>
                                        <br />
                                        @if ($product->model->variation)
                                            {{ json_encode($product->model->variation) }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                            <div class="input-group mb-3">
                                                <input style="width:50px; border: 1px solid #ffffff;" name="quantity"
                                                    class="form-control" min="1" step="1" type="number"
                                                    value="{{ $product->quantity }}">
                                                <div class="input-group-append">
                                                    <button style="border-radius: 0;" type="submit"
                                                        class="btn btn-inline py-0 px-2">{{ __('sentence.update') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>{{ Shop::price($product->price) }}</td>
                                    <td class="table-action">
                                        <a href="{{ url('/cart-destroy/' . $product->id) }}"><i
                                                class="fa fa-trash text-light"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 col-lg-6 back_to_shopping">
                        <div class="cart-back">
                            @if (App::getLocale() == 'ar')
                                <a class="btn btn-red" href="{{ url('/shop') }}"><i
                                        class="fa fa-undo-alt"></i><span>{{ __('sentence.back_to_shopping') }}</span></a>
                            @else
                                <a class="btn btn-red" href="{{ url('en/shop') }}"><i
                                        class="fa fa-undo-alt"></i><span>{{ __('sentence.back_to_shopping') }}</span></a>
                            @endif
                        </div>
                    </div>

                    @if (!session()->has('discount_code'))
                        <div class="col-md-6 col-lg-6">
                            <div class="cart-cupon">
                                <form action="{{ route('coupon') }}" method="post">
                                    @csrf
                                    <input placeholder="{{ __('sentence.do_you_have_a_discount_coupon') }}"
                                        name="coupon_code" class="bg-dark" type="text">
                                    <button class="btn btn-red" type="submit"><i
                                            class="fa fa-cut">&nbsp;</i><span>{{ __('sentence.application') }}</span></button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div dir="" class="cart-totals">
                            <h2 class="title">{{ __('sentence.basket_summary') }}</h2>
                            <ul>
                                <li><span>{{ __('sentence.total_basket') }}</span><span>{{ Shop::price(Cart::getSubTotal()) }}</span>
                                </li>
                                @if (Shop::discount() > 0)
                                    <li><span>الخصم<a href="{{ route('coupon.destroy') }}"> ( حذف
                                                )</a></span><span>{{ Shop::price(Shop::discount()) }}</span></li>
                                @endif
                                <li><span>{{ __('sentence.total_request') }}</span><span>{{ Shop::price(Shop::newTotal()) }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="cart-proceed">
                            @if (App::getLocale() == 'ar')
                                <a class="btn btn-red" href="{{ url('/checkout') }}"><i
                                        class="fa fa-check"></i>&nbsp;<span>{{ __('sentence.complete_payment') }}</span></a>
                            @else
                                <a class="btn btn-red" href="{{ url('en/checkout') }}"><i
                                        class="fa fa-check"></i>&nbsp;<span>{{ __('sentence.complete_payment') }}</span></a>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="m-4 poppins text-center ">{{ __('sentence.there_are_no_items_in_the_cart') }}</h3>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>

@endsection
